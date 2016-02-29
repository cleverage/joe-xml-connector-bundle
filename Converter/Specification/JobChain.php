<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class JobChain implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'job_chain';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\JobChain';
    }

    public static function getAttributes()
    {

        return array(
            array(
                'entityProperty' => 'distributed',
                'xmlName'        => 'distributed',
                'filterToXml' => function ($value) {
                    return $value ? 'yes' : 'no';
                },
                'filterToEntity' => function ($value) {
                    return $value == 'yes';
                },
                'default' => 'no',
            ),
            array(
                'entityProperty' => 'fileWatchingProcessClass',
                'xmlName'        => 'file_watching_process_class',
            ),
            array(
                'entityProperty' => 'maxOrders',
                'xmlName'        => 'max_orders',
                'default'        => 99999,
            ),
            array(
                'entityProperty' => 'name',
                'xmlName'        => 'name',
            ),
            array(
                'entityProperty' => 'ordersRecoverable',
                'xmlName'        => 'orders_recoverable',
                'filterToXml' => function ($value) {
                    return $value ? 'yes' : 'no';
                },
                'filterToEntity' => function ($value) {
                    return $value == 'yes';
                },
                'default' => 'yes',
            ),
            array(
                'entityProperty' => 'processClass',
                'xmlName'        => 'process_class',
            ),
            array(
                'entityProperty' => 'title',
                'xmlName'        => 'title',
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
        );
    }

    public static function getChildren()
    {
        return array(
            array(
                'entityCollectionAddMethode' => 'addFileOrderSource',
                'entityProperty'             => 'fileOrderSourceCollection',
                'spec'                       => FileOrderSource::class,
                'xmlElement'                 => 'file_order_source',
            ),
            array(
                'entityCollectionAddMethode' => 'addJobChainNode',
                'entityProperty'             => 'jobChainNodeCollection',
                'spec'                       => JobChainNode::class,
                'xmlElement'                 => 'job_chain_node',
            ),
            array(
                'entityCollectionAddMethode' => 'addFileOrderSink',
                'entityProperty'             => 'fileOrderSink',
                'spec'                       => FileOrderSink::class,
                'xmlElement'                 => 'file_order_sink',
            ),
            array(
                'entityCollectionAddMethode' => 'addJobChainNodeJobChain',
                'entityProperty'             => 'jobChainNodeJobChainCollection',
                'spec'                       => JobChainNodeJobChain::class,
                'xmlElement'                 => 'job_chain_node.job_chain',
            ),
            array(
                'entityCollectionAddMethode' => 'addJobChainNodeEnd',
                'entityProperty'             => 'jobChainNodeEndCollection',
                'spec'                       => JobChainNodeEnd::class,
                'xmlElement'                 => 'job_chain_node.end',
            ),
        );
    }
}
