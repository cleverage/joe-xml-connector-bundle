<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class Param implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'param';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\Param';
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
