<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class Ultimos implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'ultimos';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\Ultimos';
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
                'entityProperty'             => 'dayCollection',
                'spec'                       => Day::class,
                'xmlElement'                 => 'day',
            ),
        );
    }
}
