<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class ShowState implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'show_state';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\ShowState';
    }

    public static function getAttributes()
    {
        return array(
            array(
                'entityProperty' => 'maxOrders',
                'xmlName'        => 'max_orders',
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
