<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

class DelayOrderAfterSetBack implements SpecificationInterface
{

    public static function getXmlName()
    {
        return 'delay_order_after_setback';
    }

    public static function getEntityName()
    {
        return 'Arii\JOEBundle\Entity\DelayOrderAfterSetBack';
    }

    public static function getAttributes()
    {
        return array(
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
            array(
                'entityProperty' => 'setbackCount',
                'xmlName'        => 'setback_count',
            ),
            array(
                'entityProperty' => 'isMaximum',
                'xmlName'        => 'is_maximum',
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
        return array();
    }
}
