<?php
/**
 * User: mazasb
 * Date: 2016. 06. 03.
 * Time: 9:57
 */

namespace Acme\JwtAuthBundle\Payload\Claim;

trait DateTimeCreatorTrait
{
    /**
     * @param \DateTime $dateTime
     * @return static
     */
    public static function create(\DateTime $dateTime)
    {
        return new static($dateTime->getTimestamp());
    }
}