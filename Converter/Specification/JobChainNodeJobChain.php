<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class JobChainNodeJobChain implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'job_chain_node.job_chain';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\JobChainNodeJobChain';
    }

    public static function getAttributes()
    {

        return array(
            array(
                'entityProperty' => 'errorState',
                'xmlName'        => 'error_state',
            ),
            array(
                'entityProperty' => 'jobChain',
                'xmlName'        => 'job_chain',
            ),
            array(
                'entityProperty' => 'nextState',
                'xmlName'        => 'next_state',
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
