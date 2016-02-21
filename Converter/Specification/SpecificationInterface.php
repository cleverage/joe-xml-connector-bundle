<?php
/**
 * Specification Interface.
 *
 * @author Bryan Folliot <bfolliot@clever-age.com>
 */

namespace Arii\JoeXmlConnectorBundle\Converter\Specification;

interface SpecificationInterface
{
    public static function getXmlName();
    public static function getEntityName();
    public static function getAttributes();
    public static function getChildren();
}
