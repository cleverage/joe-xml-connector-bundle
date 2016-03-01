<?php

namespace Arii\JoeXmlConnectorBundle\Converter;

use DOMDocument;
use DOMNode;
use Exception;
use Arii\JoeXmlConnectorBundle\Converter\Exception\NoResultException;

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
            throw new Exception(sprintf('Converter Specification %s does not exist', $spec));
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

    /**
     * Convert XML to Entity
     *
     * @throw NoResultException
     *
     * @return "Entity"
     */
    public function toEntity()
    {
        return $this->createEntity(
            $this->xml,
            $this->spec
        );
    }

    /**
     * Convert XML to Entity
     *
     * @param DOMNode $element
     * @param string $spec Class Name of converter spec.
     *
     * @throw NoResultException
     *
     * @return "Entity"
     */
    protected function createEntity($element, $spec)
    {
        if (!$element->hasAttributes() && !$element->hasChildNodes()) {
            throw new NoResultException;
        }

        $entityName = $spec::getEntityName();

        $entity     = new $entityName;

        foreach ($spec::getAttributes() as $attributeSpec) {
            unset($value);
            if (!empty($attributeSpec['xmlChildElement'])) {
                $childElements = $element->getElementsByTagName($attributeSpec['xmlChildElement']);
                if ($childElements->length == 0) {
                    continue;
                }
                if (!$childElements->item(0)->hasAttribute($attributeSpec['xmlName'])) {
                    continue;
                }
                $value = $childElements->item(0)->getAttribute($attributeSpec['xmlName']);
            }

            if (empty($value)) {
                if (!$element->hasAttribute($attributeSpec['xmlName'])) {
                    continue;
                }
                $value = $element->getAttribute($attributeSpec['xmlName']);
            }

            $methode = 'set' . ucfirst($attributeSpec['entityProperty']);
            if (!method_exists($entity, $methode)) {
                continue;
            }
            if (!empty($value)) {
                if (!empty($attributeSpec['filterToEntity']) && is_callable($attributeSpec['filterToEntity'])) {
                    try {
                        $value = $attributeSpec['filterToEntity']($value);
                    } catch (NoResultException $e) {
                        continue;
                    }
                }
                $entity->$methode($value);
            }
        }

        if ($element->hasChildNodes()) {
            foreach ($spec::getChildren() as $childSpec) {
                if (!class_exists($childSpec['spec'])) {
                    throw new Exception(sprintf('Converter Specification %s does not exist', $childSpec['spec']));
                }
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
                    if ($childElement->parentNode->nodeName != $element->nodeName && empty($childSpec['xmlGroup'])) {
                        continue;
                    }
                    try {
                        $entity->$methode(
                            $this->createEntity($childElement, $childSpec['spec'])
                        );
                    } catch (NoResultException $e) {
                        continue;
                    }
                }
            }
        }

        if ($entity == new $entityName) {
            throw new NoResultException;
        }

        return $entity;
    }
}
