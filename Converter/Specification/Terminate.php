<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class Terminate implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'terminate';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\Terminate';
    }

    public static function getAttributes()
    {
        return array(
            array(
                'entityProperty' => 'allSchedulers',
                'xmlName'        => 'all_schedulers',
                'filterToXml' => function ($value) {
                    return $value ? 'yes' : 'no';
                },
                'filterToEntity' => function ($value) {
                    return $value == 'yes';
                },
            ),
            array(
                'entityProperty' => 'continueExclusiveOperation',
                'xmlName'        => 'continue_exclusive_operation',
                'filterToXml' => function ($value) {
                    return $value ? 'yes' : 'no';
                },
                'filterToEntity' => function ($value) {
                    return $value == 'yes';
                },
            ),
            array(
                'entityProperty' => 'restart',
                'xmlName'        => 'restart',
                'filterToXml' => function ($value) {
                    return $value ? 'yes' : 'no';
                },
                'filterToEntity' => function ($value) {
                    return $value == 'yes';
                },
            ),
            array(
                'entityProperty' => 'timeout',
                'xmlName'        => 'timeout',
            ),
        );
    }

    public static function getChildren()
    {
        return array();
    }
}
