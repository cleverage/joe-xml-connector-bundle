<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class Weekday implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'weekday';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\Weekday';
    }

    public static function getAttributes()
    {
        return array(
            array(
                'entityProperty' => 'which',
                'xmlName'        => 'which',
            ),
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
