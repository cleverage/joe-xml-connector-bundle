<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class JobChainNodeEnd implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'job_chain_node.end';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\JobChainNodeEnd';
    }

    public static function getAttributes()
    {

        return array(
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
