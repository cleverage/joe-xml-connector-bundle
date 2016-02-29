<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class FileOrderSink implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'file_order_sink';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\FileOrderSink';
    }

    public static function getAttributes()
    {

        return array(
            array(
                'entityProperty' => 'moveTo',
                'xmlName'        => 'move_to',
            ),
            array(
                'entityProperty' => 'remove',
                'xmlName'        => 'remove',
                'filterToXml' => function ($value) {
                    return $value ? 'yes' : 'no';
                },
                'filterToEntity' => function ($value) {
                    return $value == 'yes';
                },
            ),
            array(
                'entityProperty' => 'state',
                'xmlName'        => 'state',
            ),
        );
    }

    public static function getChildren()
    {
        return array();
    }
}
