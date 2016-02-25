<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class Commands implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'commands';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\Commands';
    }

    public static function getAttributes()
    {
        return array(
            array(
                'entityProperty' => 'onExitCode',
                'xmlName'        => 'on_exit_code',
            ),
        );
    }

    public static function getChildren()
    {
        return array(
            array(
                'entityCollectionAddMethode' => 'addAddJobs',
                'entityProperty'             => 'addJobsCollection',
                'spec'                       => AddJobs::class,
                'xmlElement'                 => 'add_jobs',
            ),
            array(
                'entityCollectionAddMethode' => 'addAddOrder',
                'entityProperty'             => 'addOrderCollection',
                'spec'                       => AddOrder::class,
                'xmlElement'                 => 'add_order',
            ),
            array(
                'entityCollectionAddMethode' => 'addModifyJob',
                'entityProperty'             => 'modifyJobCollection',
                'spec'                       => ModifyJob::class,
                'xmlElement'                 => 'modify_job',
            ),
            array(
                'entityCollectionAddMethode' => 'addModifyOrder',
                'entityProperty'             => 'modifyOrderCollection',
                'spec'                       => ModifyOrder::class,
                'xmlElement'                 => 'modify_order',
            ),
            array(
                'entityCollectionAddMethode' => 'addModifySpooler',
                'entityProperty'             => 'modifySpoolerCollection',
                'spec'                       => ModifySpooler::class,
                'xmlElement'                 => 'modify_spooler',
            ),
            array(
                'entityCollectionAddMethode' => 'addSchedulerLogLogCategoriesReset',
                'entityProperty'             => 'schedulerLogLogCategoriesResetCollection',
                'spec'                       => SchedulerLogLogCategoriesReset::class,
                'xmlElement'                 => 'scheduler_log.log_categories.reset',
            ),
            array(
                'entityCollectionAddMethode' => 'addSchedulerLogLogCategoriesSet',
                'entityProperty'             => 'schedulerLogLogCategoriesSetCollection',
                'spec'                       => SchedulerLogLogCategoriesSet::class,
                'xmlElement'                 => 'scheduler_log.log_categories.set',
            ),
            array(
                'entityCollectionAddMethode' => 'addSchedulerLogLogCategoriesShow',
                'entityProperty'             => 'schedulerLogLogCategoriesShowCollection',
                'spec'                       => SchedulerLogLogCategoriesShow::class,
                'xmlElement'                 => 'scheduler_log.log_categories.show',
            ),
            array(
                'entityCollectionAddMethode' => 'addShowHistory',
                'entityProperty'             => 'showHistoryCollection',
                'spec'                       => ShowHistory::class,
                'xmlElement'                 => 'show_history',
            ),
            array(
                'entityCollectionAddMethode' => 'addShowJob',
                'entityProperty'             => 'showJobCollection',
                'spec'                       => ShowJob::class,
                'xmlElement'                 => 'show_job',
            ),
            array(
                'entityCollectionAddMethode' => 'addShowJobs',
                'entityProperty'             => 'showJobsCollection',
                'spec'                       => ShowJobs::class,
                'xmlElement'                 => 'show_jobs',
            ),
            array(
                'entityCollectionAddMethode' => 'addShowJobChain',
                'entityProperty'             => 'showJobChainCollection',
                'spec'                       => ShowJobChain::class,
                'xmlElement'                 => 'show_job_chains',
            ),
            array(
                'entityCollectionAddMethode' => 'addShowState',
                'entityProperty'             => 'showStateCollection',
                'spec'                       => ShowState::class,
                'xmlElement'                 => 'show_state',
            ),
            array(
                'entityCollectionAddMethode' => 'addStartJob',
                'entityProperty'             => 'startJobCollection',
                'spec'                       => StartJob::class,
                'xmlElement'                 => 'start_job',
            ),
            array(
                'entityCollectionAddMethode' => 'addTerminate',
                'entityProperty'             => 'terminateCollection',
                'spec'                       => Terminate::class,
                'xmlElement'                 => 'terminate',
            ),
        );
    }
}
