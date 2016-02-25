<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class SchedulerLogLogCategoriesReset implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'scheduler_log.log_categories.reset';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\SchedulerLogLogCategoriesReset';
    }

    public static function getAttributes()
    {
        return array(
            array(
                'entityProperty' => 'delay',
                'xmlName'        => 'delay',
            ),
        );
    }

    public static function getChildren()
    {
        return array();
    }
}
