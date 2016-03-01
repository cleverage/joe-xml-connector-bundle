<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class Order implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'order';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\Order';
    }

    public static function getAttributes()
    {

        return array(
            array(
                'entityProperty' => 'priority',
                'xmlName'        => 'priority',
            ),
            array(
                'entityProperty' => 'title',
                'xmlName'        => 'title',
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
            array(
                'entityProperty' => 'runTime',
                'spec'           => RunTime::class,
                'xmlElement'     => 'run_time',
            ),
        );
    }
}
