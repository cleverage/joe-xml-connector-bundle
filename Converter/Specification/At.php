<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class At implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'at';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\At';
    }

    public static function getAttributes()
    {
        return array(
            array(
                'entityProperty' => 'at',
                'xmlName'        => 'at',
                'filterToXml' => function ($value) {
                    return !empty($value)
                        ? $value->format('Y-m-d')
                        : '';
                },
                'filterToEntity' => function ($value) {
                    return DateTime::createFromFormat('Y-m-d', $value);
                },
            ),
        );
    }

    public static function getChildren()
    {
        return array();
    }
}
