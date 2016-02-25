<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class StartWhenDirectoryChanged implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'start_when_directory_changed';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\StartWhenDirectoryChanged';
    }

    public static function getAttributes()
    {
        return array(
            array(
                'entityProperty' => 'directory',
                'xmlName'        => 'directory',
            ),
            array(
                'entityProperty' => 'regex',
                'xmlName'        => 'regex',
            ),
        );
    }

    public static function getChildren()
    {
        return array();
    }
}
