<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class ShowJobs implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'show_jobs';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\ShowJobs';
    }

    public static function getAttributes()
    {
        return array(
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
