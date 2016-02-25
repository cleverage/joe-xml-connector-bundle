<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

use DateTime;

class ModifyOrder implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'modify_order';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\ModifyOrder';
    }

    public static function getAttributes()
    {
        return array(
            array(
                'entityProperty' => 'action',
                'xmlName'        => 'action',
            ),
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
                'entityProperty' => 'jobChain',
                'xmlName'        => 'job_chain',
            ),
            array(
                'entityProperty' => 'orderId',
                'xmlName'        => 'order',
            ),
            array(
                'entityProperty' => 'priority',
                'xmlName'        => 'priority',
            ),
            array(
                'entityProperty' => 'setback',
                'xmlName'        => 'setback',
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
                'entityProperty' => 'suspended',
                'xmlName'        => 'suspended',
            ),
            array(
                'entityProperty' => 'title',
                'xmlName'        => 'title',
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
