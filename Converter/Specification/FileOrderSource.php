<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

use BFolliot\Date\DateInterval;
use DateTime;

class FileOrderSource implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'file_order_source';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\FileOrderSource';
    }

    public static function getAttributes()
    {

        return array(
            array(
                'entityProperty' => 'alertWhenDirectoryMissing',
                'xmlName'        => 'alert_when_directory_missing',
            ),
            array(
                'entityProperty' => 'delayAfterError',
                'xmlName'        => 'delay_after_error',
                'filterToXml' => function ($value) {
                    return $value == 0 ? 'no' : $value;
                },
                'filterToEntity' => function ($value) {
                    return $value == 'no' ? 0 : $value;
                },
            ),
            array(
                'entityProperty' => 'directory',
                'xmlName'        => 'directory',
            ),
            array(
                'entityProperty' => 'max',
                'xmlName'        => 'max',
                'default'        => 100,
            ),
            array(
                'entityProperty' => 'nextState',
                'xmlName'        => 'next_state',
            ),
            array(
                'entityProperty' => 'regex',
                'xmlName'        => 'regex',
            ),
            array(
                'entityProperty' => 'repeat',
                'xmlName'        => 'repeat',
                'filterToXml' => function ($value) {
                    return $value == 0 ? 'no' : $value;
                },
                'filterToEntity' => function ($value) {
                    return $value == 'no' ? 0 : $value;
                },
            ),
        );
    }

    public static function getChildren()
    {
        return array();
    }
}
