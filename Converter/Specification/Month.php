<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class Month implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'month';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\Month';
    }

    public static function getAttributes()
    {
        return array(
            array(
                'entityProperty' => 'month',
                'xmlName'        => 'month',
            ),
        );
    }

    public static function getChildren()
    {
        return array(
            array(
                'entityCollectionAddMethode' => 'addPeriod',
                'entityProperty'             => 'periodCollection',
                'spec'                       => Period::class,
                'xmlElement'                 => 'period',
            ),
            array(
                'entityProperty' => 'monthday',
                'spec'           => Monthday::class,
                'xmlElement'     => 'monthdays',
            ),
            array(
                'entityProperty' => 'ultimos',
                'spec'           => Ultimos::class,
                'xmlElement'     => 'ultimos',
            ),
            array(
                'entityProperty' => 'weekdays',
                'spec'           => Weekdays::class,
                'xmlElement'     => 'weekdays',
            ),
        );
    }
}
