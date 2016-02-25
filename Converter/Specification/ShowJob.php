<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class ShowJob implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'show_job';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\ShowJob';
    }

    public static function getAttributes()
    {
        return array(
            array(
                'entityProperty' => 'job',
                'xmlName'        => 'job',
            ),
            array(
                'entityProperty' => 'jobChain',
                'xmlName'        => 'job_chain',
            ),
            array(
                'entityProperty' => 'maxOrders',
                'xmlName'        => 'max_orders',
            ),
            array(
                'entityProperty' => 'maxTaskHistory',
                'xmlName'        => 'max_task_history',
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
