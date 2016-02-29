<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

use BFolliot\Date\DateInterval;
use DateTime;

class JobChainNode implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'job_chain_node';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\JobChainNode';
    }

    public static function getAttributes()
    {

        return array(
            array(
                'entityProperty' => 'delay',
                'xmlName'        => 'delay',
                'default'        => 0,
            ),
            array(
                'entityProperty' => 'errorState',
                'xmlName'        => 'error_state',
            ),
            array(
                'entityProperty' => 'job',
                'xmlName'        => 'job',
            ),
            array(
                'entityProperty' => 'nextState',
                'xmlName'        => 'next_state',
            ),
            array(
                'entityProperty' => 'onError',
                'xmlName'        => 'on_error',
            ),
            array(
                'entityProperty' => 'state',
                'xmlName'        => 'state',
            ),
        );
    }

    public static function getChildren()
    {
        return array(
            array(
                'entityCollectionAddMethode' => 'addOnReturnCode',
                'entityProperty'             => 'onReturnCodeCollection',
                'spec'                       => OnReturnCode::class,
                'xmlElement'                 => 'on_return_code',
                'xmlGroup'                   => 'on_return_codes',
            ),
        );
    }
}
