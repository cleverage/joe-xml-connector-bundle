<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class Params implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'params';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\Params';
    }

    public static function getAttributes()
    {
        return array();
    }

    public static function getChildren()
    {
        return array(
            array(
                'entityCollectionAddMethode' => 'addParam',
                'entityProperty'             => 'paramCollection',
                'spec'                       => Param::class,
                'xmlElement'                 => 'param',
            ),
            array(
                'entityCollectionAddMethode' => 'addCopyParams',
                'entityProperty'             => 'copyParamsCollection',
                'spec'                       => CopyParams::class,
                'xmlElement'                 => 'copy_params',
            ),
            array(
                'entityCollectionAddMethode' => 'addInclude',
                'entityProperty'             => 'includes',
                'spec'                       => IncludeFile::class,
                'xmlElement'                 => 'include',
            ),
        );
    }
}
