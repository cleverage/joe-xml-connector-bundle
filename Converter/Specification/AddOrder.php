<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

use DateTime;

class AddOrder implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'add_order';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\AddOrder';
    }

    public static function getAttributes()
    {
        return array(
            array(
                'entityProperty' => 'at',
                'xmlName'        => 'at',
                'filterToXml' => function ($value) {
                    return $value->getTimestamp();
                },
                'filterToEntity' => function ($value) {
                    $dateTime = new DateTime;
                    $dateTime->setTimestamp($value);
                    return $dateTime;
                },
            ),
            array(
                'entityProperty' => 'endState',
                'xmlName'        => 'end_state',
            ),
            array(
                'entityProperty' => 'orderId',
                'xmlName'        => 'id',
            ),
            array(
                'entityProperty' => 'jobChain',
                'xmlName'        => 'job_chain',
            ),
            array(
                'entityProperty' => 'priority',
                'xmlName'        => 'priority',
            ),
            array(
                'entityProperty' => 'replace',
                'xmlName'        => 'replace',
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
            array(
                'entityProperty' => 'title',
                'xmlName'        => 'title',
            ),
            array(
                'entityProperty' => 'webService',
                'xmlName'        => 'web_service',
            ),
        );
    }

    public static function getChildren()
    {
        return array(
            array(
                'entityProperty' => 'params',
                'spec'           => Params::class,
                'xmlElement'     => 'params',
            ),
            array(
                'entityProperty' => 'runTime',
                'spec'           => RunTime::class,
                'xmlElement'     => 'run_time',
            ),
        );
    }
}
