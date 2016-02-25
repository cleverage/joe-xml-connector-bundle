<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class Weekdays implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'weekdays';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\Weekdays';
    }

    public static function getAttributes()
    {
        return array();
    }

    public static function getChildren()
    {
        // var_dump('here');
        // exit;
        return array(
            array(
                'entityCollectionAddMethode' => 'addDay',
                'entityProperty'             => 'days',
                'spec'                       => Day::class,
                'xmlElement'                 => 'day',
            ),
        );
    }
}
