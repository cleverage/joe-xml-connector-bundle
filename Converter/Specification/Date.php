<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class Date implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'date';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\Date';
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
        return array(
            array(
                'entityCollectionAddMethode' => 'addPeriod',
                'entityProperty'             => 'periods',
                'spec'                       => Period::class,
                'xmlElement'                 => 'period',
            ),
        );
    }
}
