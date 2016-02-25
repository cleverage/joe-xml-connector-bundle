<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class ShowJobChain implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'show_job_chain';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\ShowJobChain';
    }

    public static function getAttributes()
    {
        return array(
            array(
                'entityProperty' => 'maxOrderHistory',
                'xmlName'        => 'max_order_history',
            ),
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
