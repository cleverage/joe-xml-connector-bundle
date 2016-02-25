<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class SchedulerLogLogCategoriesSet implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'scheduler_log.log_categories.set';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\SchedulerLogLogCategoriesSet';
    }

    public static function getAttributes()
    {
        return array(
            array(
                'entityProperty' => 'category',
                'xmlName'        => 'category',
            ),
            array(
                'entityProperty' => 'value',
                'xmlName'        => 'value',
            ),
        );
    }

    public static function getChildren()
    {
        return array();
    }
}
