<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class SchedulerLogLogCategoriesShow implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'scheduler_log.log_categories.show';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\SchedulerLogLogCategoriesShow';
    }

    public static function getAttributes()
    {
        return array();
    }

    public static function getChildren()
    {
        return array();
    }
}
