<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class LockUse implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'lock.use';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\LockUse';
    }

    public static function getAttributes()
    {
        return array();
    }

    public static function getChildren()
    {
        return array();
    }
}
