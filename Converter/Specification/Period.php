<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

use BFolliot\Date\DateInterval;
use DateTime;

class Period extends AbstractTime
{

    public static function getXmlName()
    {
        return 'period';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\Period';
    }

    public static function getAttributes()
    {
        return array_merge(
            parent::getAttributes(),
            array(
                array(
                    'entityProperty' => 'absoluteRepeat',
                    'xmlName'        => 'absolute_repeat',
                ),
            )
        );
    }

    public static function getChildren()
    {
        return array();
    }
}
