<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class Day implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'day';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\Day';
    }

    public static function getAttributes()
    {
        return array(
            array(
                'entityProperty' => 'day',
                'xmlName'        => 'day',
            ),
        );
    }

    public static function getChildren()
    {
        return array(
            array(
                'entityCollectionAddMethode' => 'addPeriod',
                'entityProperty'             => 'periods',
                'spec'                       => Period::class,
                'xmlElement'                 => 'period',
            ),
        );
    }
}
