<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

use DateTime;

class StartJob implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'start_job';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\StartJob';
    }

    public static function getAttributes()
    {
        return array(
            array(
                'entityProperty' => 'after',
                'xmlName'        => 'after',
            ),
            array(
                'entityProperty' => 'at',
                'xmlName'        => 'at',
                'filterToXml' => function ($value) {
                    return $value->format('Y-m-d h:m:s');
                },
                'filterToEntity' => function ($value) {
                    if ($value == 'now') {
                        return new DateTime;
                    }

                    $dateTime = DateTime::createFromFormat('Y-m-d h:m:s', $value);

                    if (!$dateTime) {
                        return new DateTime;
                    } else {
                        return $dateTime;
                    }
                },
            ),
            array(
                'entityProperty' => 'force',
                'xmlName'        => 'force',
                'filterToXml' => function ($value) {
                    return $value ? 'yes' : 'no';
                },
                'filterToEntity' => function ($value) {
                    return $value == 'yes';
                },
            ),
            array(
                'entityProperty' => 'job',
                'xmlName'        => 'job',
            ),
            array(
                'entityProperty' => 'name',
                'xmlName'        => 'name',
            ),
            array(
                'entityProperty' => 'web_service',
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
                'entityCollectionAddMethode' => 'addVariable',
                'entityProperty'             => 'environmentVariables',
                'spec'                       => Variable::class,
                'xmlElement'                 => 'variable',
                'xmlGroup'                   => 'environment',
            ),
        );
    }
}
