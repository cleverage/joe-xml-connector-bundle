<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class Holidays implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'holidays';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\Holidays';
    }

    public static function getAttributes()
    {
        return array();
    }

    public static function getChildren()
    {
        return array(
            array(
                'entityCollectionAddMethode' => 'addWeekdays',
                'entityProperty'             => 'weekdaysCollection',
                'spec'                       => Weekdays::class,
                'xmlElement'                 => 'weekdays',
            ),
            array(
                'entityCollectionAddMethode' => 'addHoliday',
                'entityProperty'             => 'holidayCollection',
                'spec'                       => Holiday::class,
                'xmlElement'                 => 'holiday',
            ),
            array(
                'entityCollectionAddMethode' => 'addInclude',
                'entityProperty'             => 'includeCollection',
                'spec'                       => IncludeFile::class,
                'xmlElement'                 => 'include',
            ),
        );
    }
}
