<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

use DateTime;

class Monitor implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'monitor';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\Monitor';
    }

    public static function getAttributes()
    {

        return array(
            array(
                'entityProperty' => 'name',
                'xmlName'        => 'name',
            ),
            array(
                'entityProperty' => 'ordering',
                'xmlName'        => 'ordering',
            ),
        );
    }

    public static function getChildren()
    {
        return array(
            array(
                'entityProperty' => 'script',
                'xmlElement'     => 'script',
                'spec'           => Script::class,
            ),
        );
    }
}
