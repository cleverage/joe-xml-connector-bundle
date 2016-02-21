<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class Variable implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'variable';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\Variable';
    }

    public static function getAttributes()
    {
        return array(
            array(
                'entityProperty' => 'name',
                'xmlName'        => 'name',
            ),
            array(
                'entityProperty' => 'value',
                'xmlName'        => 'value',
            ),
        );
    }

    public static function getChildren()
    {
        return array();
    }
}
