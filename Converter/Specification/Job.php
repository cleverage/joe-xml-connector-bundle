<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

use DateTime;

class Job
{

    public static function getXmlName()
    {
        return 'job';
    }

    public function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\Job';
    }

    public static function getAttributes()
    {

        return array(
            array(
                'entityProperty' => 'spoolerId',
                'xmlName'        => 'spooler_id',
            ),
            array(
                'entityProperty' => 'name',
                'xmlName'        => 'name',
            ),
            array(
                'entityProperty' => 'title',
                'xmlName'        => 'title',
            ),
            array(
                'entityProperty' => 'order',
                'xmlName'        => 'order',
                'filterToXml' => function ($value) {
                    return $value ? 'yes' : 'no';
                },
                'filterToEntity' => function ($value) {
                    return $value == 'yes';
                },
            ),
            array(
                'entityProperty' => 'processClass',
                'xmlName'        => 'process_class',
            ),
            array(
                'entityProperty' => 'tasks',
                'xmlName'        => 'tasks',
            ),
            array(
                'entityProperty' => 'minTasks',
                'xmlName'        => 'min_tasks',
            ),
            array(
                'entityProperty' => 'timeout',
                'xmlName'        => 'timeout',
                'filterToXml' => function ($value) {
                    return $value->format('%s');
                },
                'filterToEntity' => function ($value) {
                    throw new \Exception("TODO", 1);
                },
            ),
            array(
                'entityProperty' => 'idleTimeout',
                'xmlName'        => 'idle_timeout',
                'filterToXml' => function ($value) {
                    return $value->format('%s');
                },
                'filterToEntity' => function ($value) {
                    throw new \Exception("TODO", 1);
                },
            ),
            array(
                'entityProperty' => 'forceIdleTimeout',
                'xmlName'        => 'force_idle_timeout',
                'filterToXml' => function ($value) {
                    return $value ? 'yes' : 'no';
                },
                'filterToEntity' => function ($value) {
                    return $value == 'yes';
                },
            ),
            array(
                'entityProperty' => 'priority',
                'xmlName'        => 'priority',
            ),
            array(
                'entityProperty' => 'temporary',
                'xmlName'        => 'temporary',
                'filterToXml' => function ($value) {
                    return $value ? 'yes' : 'no';
                },
                'filterToEntity' => function ($value) {
                    return $value == 'yes';
                },
            ),
            array(
                'entityProperty' => 'javaOptions',
                'xmlName'        => 'java_options',
            ),
            array(
                'entityProperty' => 'visible',
                'xmlName'        => 'visible',
                'filterToXml' => function ($value) {
                    if ($value == -1) {
                        return 'never';
                    } elseif ($value == 1) {
                        return 'yes';
                    }
                    return 'no';
                },
                'filterToEntity' => function ($value) {
                    if ($value == 'never') {
                        return -1;
                    } elseif ($value == 'yes') {
                        return 1;
                    }
                    return 0;
                },
            ),
            array(
                'entityProperty' => 'ignoreSignals',
                'xmlName'        => 'ignore_signals',
                'filterToXml' => function ($value) {
                    return implode(' ', $value);
                },
                'filterToEntity' => function ($value) {
                    return explode(' ', $value);
                },
            ),
            array(
                'entityProperty' => 'stopOnError',
                'xmlName'        => 'stop_on_error',
                'filterToXml' => function ($value) {
                    return $value ? 'yes' : 'no';
                },
                'filterToEntity' => function ($value) {
                    return $value == 'yes';
                },
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
                'entityProperty' => 'warnIfShorterThan',
                'xmlName'        => 'warn_if_shorter_than',
                'filterToXml' => function ($value) {
                    return !empty($value)
                        ? $value->format('h:m:s')
                        : '';
                },
                'filterToEntity' => function ($value) {
                    return DateTime::createFromFormat('h:m:s', $value);
                },
            ),
            array(
                'entityProperty' => 'warnIfLongerThan',
                'xmlName'        => 'warn_if_longer_than',
                'filterToXml' => function ($value) {
                    return !empty($value)
                        ? $value->format('h:m:s')
                        : '';
                },
                'filterToEntity' => function ($value) {
                    return DateTime::createFromFormat('h:m:s', $value);
                },
            ),
            array(
                'entityProperty' => 'enabled',
                'xmlName'        => 'enabled',
                'filterToXml' => function ($value) {
                    return $value ? 'yes' : 'no';
                },
                'filterToEntity' => function ($value) {
                    return $value == 'yes';
                },
            ),

        );
    }

    public static function getChildren()
    {
        return array(
            array(
                'entityProperty' => 'description',
                'xmlGroup'       => 'description',
                'xmlElement'     => 'include',
                'spec'           => IncludeFile::class,
            ),
            array(
                'entityProperty' => 'environmentVariables',
                'xmlGroup'       => 'environment',
                'xmlElement'     => 'variable',
                'spec'           => Variable::class,
            ),
            array(
                'entityProperty' => 'lockUses',
                'xmlElement'     => 'lock.use',
                'spec'           => LockUse::class,
            ),
        );
    }
}
