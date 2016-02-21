<?php

namespace Arii\JoeXmlConnectorBundle\Converter;

use DOMDocument;
use DOMNode;
use Exception;

class XMLToEntity
{
    protected $xml;
    protected $spec;

    public function __construct($xml, $spec)
    {
        if (!$xml instanceof DOMNode) {
            $this->xml = new DOMDocument;
            if (is_file($xml)) {
                $this->xml->load(realpath($xml));
            } else {
                $this->xml->loadXML($xml);
            }
            if ($this->xml === false) {
                throw new Exception("Error Processing XML.");
            }
        }

        if (!class_exists($spec)) {
            throw new Exception("Specification class does not exist.");
        }

        if ($this->xml->nodeName == '#document') {
            $this->xml = $this->xml->firstChild;
        }

        if ($this->xml->nodeName != $spec::getXmlName()) {
            throw new Exception(
                sprintf('XML node "%s" is not "%s"', $this->xml->nodeName, $spec::getXmlName())
            );

        }

        $this->spec = $spec;
        return $this;
    }

    public function toEntity()
    {
        return $this->createEntity(
            $this->xml,
            $this->spec
        );
    }

    protected function createEntity($element, $spec)
    {
        $entityName = $spec::getEntityName();
        $entity     = new $entityName;

        foreach ($spec::getAttributes() as $attributeSpec) {

            if (!$element->hasAttribute($attributeSpec['xmlName'])) {
                continue;
            }
            $value = $element->getAttribute($attributeSpec['xmlName']);

            $methode = 'set' . ucfirst($attributeSpec['entityProperty']);
            if (!method_exists($entity, $methode)) {
                continue;
            }
            if (!empty($value)) {
                if (!empty($attributeSpec['filterToEntity']) && is_callable($attributeSpec['filterToEntity'])) {
                    $value = $attributeSpec['filterToEntity']($value);
                }
                $entity->$methode($value);
            }
        }


        if (!$element->hasChildNodes()) {
            return $entity;
        }

        foreach ($spec::getChildren() as $childSpec) {
            if (!empty($childSpec['xmlGroup'])) {
                $group = $element->getElementsByTagName($childSpec['xmlGroup']);
                if ($group->length == 0) {
                    continue;
                }

                $childElements = $group->item(0)->getElementsByTagName($childSpec['xmlElement']);
            } else {
                $childElements = $element->getElementsByTagName($childSpec['xmlElement']);
            }

            if ($childElements->length == 0) {
                continue;
            }



            if (!empty($childSpec['entityCollectionAddMethode'])) {
                $methode = $childSpec['entityCollectionAddMethode'];
            } else {
                $methode = 'set' . ucfirst($childSpec['entityProperty']);
            }


            if (!method_exists($entity, $methode)) {
                continue;
            }

            foreach ($childElements as $childElement) {
                $entity->$methode(
                    $this->createEntity($childElement, $childSpec['spec'])
                );
            }
        }
        return $entity;
    }
}
