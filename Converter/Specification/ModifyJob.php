<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class ModifyJob implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'modify_job';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\ModifyJob';
    }

    public static function getAttributes()
    {
        return array(
            array(
                'entityProperty' => 'cmd',
                'xmlName'        => 'cmd',
            ),
            array(
                'entityProperty' => 'job',
                'xmlName'        => 'job',
            ),
        );
    }

    public static function getChildren()
    {
        return array();
    }
}
