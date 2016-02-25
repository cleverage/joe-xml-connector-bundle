<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

use BFolliot\Date\DateInterval;
use DateTime;

class RunTime extends AbstractTime
{

    public static function getXmlName()
    {
        return 'run_time';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\RunTime';
    }

    public static function getAttributes()
    {
        return array_merge(
            parent::getAttributes(),
            array(
                array(
                    'entityProperty' => 'once',
                    'xmlName'        => 'once',
                    'filterToXml' => function ($value) {
                        return $value ? 'yes' : 'no';
                    },
                    'filterToEntity' => function ($value) {
                        return $value == 'yes';
                    },
                    'default' => 'no',
                ),
                array(
                    'entityProperty' => 'timeZone',
                    'xmlName'        => 'time_zone',
                ),
                array(
                    'entityProperty' => 'schedule',
                    'xmlName'        => 'schedule',
                ),
            )
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
            array(
                'entityCollectionAddMethode' => 'addAts',
                'entityProperty'             => 'ats',
                'spec'                       => At::class,
                'xmlElement'                 => 'at',
            ),
            array(
                'entityCollectionAddMethode' => 'addDate',
                'entityProperty'             => 'dates',
                'spec'                       => Date::class,
                'xmlElement'                 => 'date',
            ),
            array(
                'entityCollectionAddMethode' => 'addWeekdays',
                'entityProperty'             => 'weekdaysCollection',
                'spec'                       => Weekdays::class,
                'xmlElement'                 => 'weekdays',
            ),
            array(
                'entityCollectionAddMethode' => 'addMonthday',
                'entityProperty'             => 'monthdayCollection',
                'spec'                       => Monthday::class,
                'xmlElement'                 => 'monthday',
            ),
            array(
                'entityCollectionAddMethode' => 'addMonth',
                'entityProperty'             => 'monthCollection',
                'spec'                       => Month::class,
                'xmlElement'                 => 'month',
            ),
            array(
                'entityCollectionAddMethode' => 'addUltimos',
                'entityProperty'             => 'ultimosCollection',
                'spec'                       => Ultimos::class,
                'xmlElement'                 => 'ultimos',
            ),
            array(
                'entityProperty' => 'holidays',
                'spec'           =>  Holidays::class,
                'xmlElement'     => 'holidays',
            ),
        );
    }
}
