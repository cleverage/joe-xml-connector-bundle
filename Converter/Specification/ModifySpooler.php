<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class ModifySpooler implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'modify_spooler';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\ModifySpooler';
    }

    public static function getAttributes()
    {
        return array(
            array(
                'entityProperty' => 'cmd',
                'xmlName'        => 'cmd',
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
