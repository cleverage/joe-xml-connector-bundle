<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class DelayAfterError implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'delay_after_error';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\DelayAfterError';
    }

    public static function getAttributes()
    {
        return array(
            array(
                'entityProperty' => 'errorCount',
                'xmlName'        => 'error_count',
            ),
            array(
                'entityProperty' => 'delay',
                'xmlName'        => 'delay',
                'filterToXml' => function ($value) {
                    if (!empty($value)) {
                        return $value->format('%s');
                    }
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
                            throw new \Exception("Bad Format for delay");
                            break;
                    }
                    return new DateInterval($return);
                },
            ),
        );
    }

    public static function getChildren()
    {
        return array();
    }
}
