<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class IncludeFile implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'include';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\IncludeFile';
    }

    public static function getAttributes()
    {
        return array(
            array(
                'entityProperty' => 'file',
                'xmlName'        => 'file',
            ),
            array(
                'entityProperty' => 'liveFile',
                'xmlName'        => 'live_file',
            ),
            array(
                'entityProperty' => 'node',
                'xmlName'        => 'node',
            ),
        );
    }

    public static function getChildren()
    {
        return array();
    }
}
