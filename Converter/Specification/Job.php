<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

use BFolliot\Date\DateInterval;
use DateTime;

class Job implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'job';
    }

    public static function getEntityName()
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
                'default'        => 1,
            ),
            array(
                'entityProperty' => 'minTasks',
                'xmlName'        => 'min_tasks',
                'default'        => 0,
            ),
            array(
                'entityProperty' => 'timeout',
                'xmlName'        => 'timeout',
                'filterToXml' => function ($value) {
                    return $value->format('%s');
                },
                'filterToEntity' => function ($value) {
                    $value = explode(':', $value);
                    $return = 'PT';
                    switch (count($value)) {
                        case 1:
                            $return .= $value[0] . 'S';
                            break;
                        case 2:
                            $return .= $value[0] . 'M' . $value[1] . 'S';
                            break;
                        case 3:
                            $return .= $value[0] . 'H' . $value[1] . 'M' . $value[2] . 'S';
                            break;

                        default:
                            throw new \Exception("Bad Format for timeout");
                            break;
                    }
                    return new DateInterval($return);
                },
                'default' => 0,
            ),
            array(
                'entityProperty' => 'idleTimeout',
                'xmlName'        => 'idle_timeout',
                'filterToXml' => function ($value) {
                    return $value->format('%s');
                },
                'filterToEntity' => function ($value) {
                    $value = explode(':', $value);
                    $return = 'PT';
                    switch (count($value)) {
                        case 1:
                            $return .= $value[0] . 'S';
                            break;
                        case 2:
                            $return .= $value[0] . 'M' . $value[1] . 'S';
                            break;
                        case 3:
                            $return .= $value[0] . 'H' . $value[1] . 'M' . $value[2] . 'S';
                            break;

                        default:
                            throw new \Exception("Bad Format for idle_timeout");
                            break;
                    }
                    return new DateInterval($return);
                },
                'default' => 5,
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
                'default' => 'no',
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
                'default' => 'no',
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
                'default' => 'yes',
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
                'default' => 'all',
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
                'default' => 'yes',
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
                'default' => 'yes',
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
                'default' => 'yes',
            ),

        );
    }

    public static function getChildren()
    {
        return array(
            array(
                'entityProperty' => 'description',
                'spec'           => IncludeFile::class,
                'xmlElement'     => 'include',
                'xmlGroup'       => 'description',
            ),
            array(
                'entityCollectionAddMethode' => 'addLockUse',
                'entityProperty'             => 'lockUses',
                'spec'                       => LockUse::class,
                'xmlElement'                 => 'lock.use',
            ),
            array(
                'entityCollectionAddMethode' => 'addEnvironmentVariable',
                'entityProperty'             => 'environmentVariables',
                'spec'                       => Variable::class,
                'xmlElement'                 => 'variable',
                'xmlGroup'                   => 'environment',
            ),
            array(
                'entityProperty' => 'params',
                'spec'           => Params::class,
                'xmlElement'     => 'params',
            ),
            array(
                'entityProperty' => 'script',
                'spec'           => Script::class,
                'xmlElement'     => 'script',
            ),
            array(
                'entityProperty' => 'monitor',
                'spec'           => Monitor::class,
                'xmlElement'     => 'monitor',
            ),
            array(
                'entityCollectionAddMethode' => 'addStartWhenDirectoryChanged',
                'entityProperty'             => 'startWhenDirectoryChanged',
                'spec'                       => StartWhenDirectoryChanged::class,
                'xmlElement'                 => 'start_when_directory_changed',
            ),
            array(
                'entityCollectionAddMethode' => 'addDelayAfterError',
                'entityProperty'             => 'delayAfterError',
                'spec'                       => DelayAfterError::class,
                'xmlElement'                 => 'delay_after_error',
            ),
            array(
                'entityCollectionAddMethode' => 'addDelayOrderAfterSetBack',
                'entityProperty'             => 'delayOrderAfterSetBack',
                'spec'                       => DelayOrderAfterSetBack::class,
                'xmlElement'                 => 'delay_order_after_setback',
            ),
            array(
                'entityProperty' => 'runTime',
                'spec'           => RunTime::class,
                'xmlElement'     => 'run_time',
            ),
            array(
                'entityCollectionAddMethode' => 'addCommands',
                'entityProperty'             => 'commandsCollection',
                'spec'                       => Commands::class,
                'xmlElement'                 => 'commands',
            ),
        );
    }
}
