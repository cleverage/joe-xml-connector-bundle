<?php

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

use BFolliot\Date\DateInterval;
use DateTime;

use Arii\JoeXmlConnectorBundle\Converter\Exception\NoResultException;

abstract class AbstractTime implements SpecificationInterface
{

    public static function getAttributes()
    {
        return array(
            array(
                'entityProperty' => 'begin',
                'xmlName'        => 'begin',
                'filterToXml' => function ($value) {
                    return !empty($value)
                        ? $value->format('h:m:s')
                        : '';
                },
                'filterToEntity' => function ($value) {
                    if (empty($value)) {
                        throw new NoResultException;
                    }
                    $dateTime = DateTime::createFromFormat('h:m:s', $value);
                    if (!$dateTime) {
                        $dateTime = DateTime::createFromFormat('h:m', $value);
                        if (!$dateTime) {
                            throw new NoResultException;
                        }
                    }
                    return $dateTime;
                },
            ),
            array(
                'entityProperty' => 'end',
                'xmlName'        => 'end',
                'filterToXml' => function ($value) {
                    return !empty($value)
                        ? $value->format('h:m:s')
                        : '';
                },
                'filterToEntity' => function ($value) {
                    if (empty($value)) {
                        throw new NoResultException;
                    }
                    $dateTime = DateTime::createFromFormat('h:m:s', $value);
                    if (!$dateTime) {
                        $dateTime = DateTime::createFromFormat('h:m', $value);
                        if (!$dateTime) {
                            throw new NoResultException;
                        }
                    }
                    return $dateTime;
                },
            ),
            array(
                'entityProperty' => 'letRun',
                'xmlName'        => 'let_run',
                'filterToXml' => function ($value) {
                    return $value ? 'yes' : 'no';
                },
                'filterToEntity' => function ($value) {
                    return $value == 'yes';
                },
                'default' => 'no',
            ),
            array(
                'entityProperty' => 'singleStart',
                'xmlName'        => 'single_start',
                'filterToXml' => function ($value) {
                    return !empty($value)
                        ? $value->format('h:m:s')
                        : '';
                },
                'filterToEntity' => function ($value) {
                    if (empty($value)) {
                        throw new NoResultException;
                    }
                    $dateTime = DateTime::createFromFormat('h:m:s', $value);
                    if (!$dateTime) {
                        $dateTime = DateTime::createFromFormat('h:m', $value);
                        if (!$dateTime) {
                            throw new NoResultException;
                        }
                    }
                    return $dateTime;
                },
            ),
            array(
                'entityProperty' => 'whenHoliday',
                'xmlName'        => 'when_holiday',
            ),
            array(
                'entityProperty' => 'repeat',
                'xmlName'        => 'repeat',
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
                            throw new \Exception("Bad Format for repeat");
                            break;
                    }
                    return new DateInterval($return);
                },
            ),
        );
    }
}
