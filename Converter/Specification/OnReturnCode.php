<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

use BFolliot\Date\DateInterval;
use DateTime;

class OnReturnCode implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'on_return_code';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\OnReturnCode';
    }

    public static function getAttributes()
    {
        return array(
            array(
                'entityProperty' => 'returnCode',
                'xmlName'        => 'return_code',
            ),
            array(
                'entityProperty'  => 'state',
                'xmlName'         => 'state',
                'xmlChildElement' => 'to_state',
            ),
        );
    }

    public static function getChildren()
    {
        return array(
            array(
                'entityProperty' => 'onReturnCodeAddOrder',
                'spec'           => OnReturnCodeAddOrder::class,
                'xmlElement'     => 'add_order',
            ),
        );
    }
}
