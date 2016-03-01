<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class Lock implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'lock';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\Lock';
    }

    public static function getAttributes()
    {
        return array(
            array(
                'entityProperty' => 'name',
                'xmlName'        => 'name',
            ),
            array(
                'entityProperty' => 'maxNonExclusive',
                'xmlName'        => 'max_non_exclusive',
            ),
        );
    }

    public static function getChildren()
    {
        return array();
    }
}
