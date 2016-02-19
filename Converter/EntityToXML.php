<?php

namespace Arii\JoeXmlConnectorBundle\Converter;

use DOMDocument;

class EntityToXML
{
    protected $entity;
    protected $spec;
    protected $document;

    public function __construct($entity, $spec)
    {
        $this->entity   = $entity;
        $this->spec     = $spec;
        $this->document = new DOMDocument;
        $this->document->preserveWhiteSpace = false;
        $this->document->formatOutput = true;
    }

    public function toXML()
    {
        $this->document->appendChild(
            $this->createElement(
                $this->entity,
                $this->spec
            )
        );
        return $this->document->saveXML();
    }

    protected function createElement($entity, $spec)
    {
        $element = $this->document->createElement($spec::getXmlName());

        foreach ($spec::getAttributes() as $attributeSpec) {
            $methode = 'get' . ucfirst($attributeSpec['entityProperty']);
            if (method_exists($entity, $methode)) {
                $value = $entity->$methode();
            } else {
                $value = false;
            }
            if (!empty($value)) {
                if (!empty($attributeSpec['filterToXml']) && is_callable($attributeSpec['filterToXml'])) {
                    $value = $attributeSpec['filterToXml']($value);
                }
                $element->setAttribute(
                    $attributeSpec['xmlName'],
                    $value
                );
            }
        }

        foreach ($spec::getChildren() as $childSpec) {
            $methode = 'get' . ucfirst($childSpec['entityProperty']);
            if (method_exists($entity, $methode)) {
                $value = $entity->$methode();
            } else {
                $value = false;
            }
            if (!empty($value)) {
                if (!empty($childSpec['xmlGroup'])) {
                    $parent = $this->document->createElement($childSpec['xmlGroup']);
                } else {
                    $parent = $element;
                }

                if (is_array($value)) {
                    foreach ($value as $childValue) {
                        $parent->appendChild(
                            $this->createElement($childValue, $childSpec['spec'])
                        );
                    }
                } else {
                    $parent->appendChild(
                        $this->createElement($value, $childSpec['spec'])
                    );
                }

                if (!empty($childSpec['xmlGroup'])) {
                    $element->appendChild($parent);
                }
            }
        }

        return $element;
    }
}
