<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class Holiday implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'holiday';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\Holiday';
    }

    public static function getAttributes()
    {
        return array(
            array(
                'entityProperty' => 'date',
                'xmlName'        => 'date',
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
