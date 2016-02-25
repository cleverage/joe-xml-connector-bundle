<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class Monthday implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'monthdays';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\Monthday';
    }

    public static function getAttributes()
    {
        return array();
    }

    public static function getChildren()
    {
        return array(
            array(
                'entityCollectionAddMethode' => 'addDay',
                'entityProperty'             => 'days',
                'spec'                       => Day::class,
                'xmlElement'                 => 'day',
            ),
            array(
                'entityCollectionAddMethode' => 'addWeekday',
                'entityProperty'             => 'weekdayCollection',
                'spec'                       => Weekday::class,
                'xmlElement'                 => 'weekday',
            ),
        );
    }
}
