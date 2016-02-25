<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class ShowHistory implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'show_history';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\ShowHistory';
    }

    public static function getAttributes()
    {
        return array(
            array(
                'entityProperty' => 'id',
                'xmlName'        => 'id',
            ),
            array(
                'entityProperty' => 'job',
                'xmlName'        => 'job',
            ),
            array(
                'entityProperty' => 'next',
                'xmlName'        => 'next',
            ),
            array(
                'entityProperty' => 'prev',
                'xmlName'        => 'prev',
            ),
            array(
                'entityProperty' => 'what',
                'xmlName'        => 'what',
            ),
        );
    }

    public static function getChildren()
    {
        return array();
    }
}
