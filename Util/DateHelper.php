<?php
/**
 * User: mazasb
 * Date: 2016. 06. 03.
 * Time: 10:01
 */

namespace Acme\JwtAuthBundle\Util;

class DateHelper
{
    /**
     * @param $timestamp
     * @return bool
     */
    public static function isPast($timestamp)
    {
        return (new \DateTime())->getTimestamp() > $timestamp;
    }
}