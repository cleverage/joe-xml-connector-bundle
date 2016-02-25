<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class AddJobs implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'add_jobs';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\AddJobs';
    }

    public static function getAttributes()
    {
        return array();
    }

    public static function getChildren()
    {
        return array(
            array(
                'entityCollectionAddMethode' => 'addJob',
                'entityProperty'             => 'jobCollection',
                'spec'                       => Job::class,
                'xmlElement'                 => 'job',
            ),
        );
    }
}
