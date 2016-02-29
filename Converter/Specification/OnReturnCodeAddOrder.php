<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

use BFolliot\Date\DateInterval;
use DateTime;

class OnReturnCodeAddOrder implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'add_order';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\OnReturnCodeAddOrder';
    }

    public static function getAttributes()
    {
        return array(
            array(
                'entityProperty' => 'jobChain',
                'xmlName'        => 'job_chain',
            ),
            array(
                'entityProperty' => 'xmlns',
                'xmlName'        => 'xmlns',
            ),
        );
    }

    public static function getChildren()
    {
        return array(
            array(
                'entityProperty' => 'params',
                'spec'           => Params::class,
                'xmlElement'     => 'params',
            ),
        );
    }
}
