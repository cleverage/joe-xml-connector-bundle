# Converter

## Entity to XML

* Class : Arii\JoeXmlConnectorBundle\Converter\EntityToXML

### Example

```php
<?php

// ...

$converter = new EntityToXML(
    $entity,
    \Arii\JoeXmlConnectorBundle\Converter\Specification\Example::class
);
$xml = $converter->toXML();

// ...

```


## XML to Entity

* Class : Arii\JoeXmlConnectorBundle\Converter\XMLToEntity

### Example

```php
<?php

// ...

$converter = new XMLToEntity(
    $filePath,
    \Arii\JoeXmlConnectorBundle\Converter\Specification\Example::class
);
$entity = $converter->toEntity();

// ...

```


## Converter Specification

Interface: `Arii\JoeXmlConnectorBundle\Converter\Specification`


### Example of Specification class

```php
<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class Example implements SpecificationInterface
{
    /**
     * Name of the XML Element
     */
    public static function getXmlName()
    {
        return 'example';
    }
    /**
     * Name of the entity class.
     */
    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\Example';
    }

    /**
     * Attributes specification.
     */
    public static function getAttributes()
    {

        return array(
            // Simple relation
            array(
                'entityProperty' => 'exampleAttribute', // Entity property name.
                'xmlName'        => 'example_attribute', // XML attribute name.
                'default'        => 0, // (optional) Default XML value.
            ),

            // Relation with transformation (in example, boolean <=> yes|no)
            array(
                'entityProperty' => 'exampleAttribute', // Entity property name.
                'xmlName'        => 'example_attribute', // XML attribute name.
                'filterToXml' => function ($value) {
                    return $value ? 'yes' : 'no';
                },
                'filterToEntity' => function ($value) {
                    return $value == 'yes';
                },
                'default'        => 'no', // (optional) Default XML value.
            ),
        );
    }

    /**
     * Children elements specification.
     */
    public static function getChildren()
    {
        return array(
            // OneToOne
            array(
                'entityProperty' => 'name', // Entity property name.
                'spec'           => Name::class, // Spec class name.
                'xmlElement'     => 'name', // XML element name.
            ),

            //OneToOne + group
            array(
                'entityProperty' => 'description', // Entity property name.
                'spec'           => IncludeFile::class, // Spec class name.
                'xmlElement'     => 'include', // XML element name.
                'xmlGroup'       => 'description', // (optional) XML group element name
            ),

            // Collection
            array(
                'entityCollectionAddMethode' => 'addExample', // Methode to add a child in entity.
                'entityProperty'             => 'examplesCollection', // Entity property name.
                'spec'                       => Example::class, // Spec class name.
                'xmlElement'                 => 'example', // XML element name.
                'xmlGroup'                   => 'example_group', // (optional) XML group element name
            ),

        );
    }
}

```
