<?php
/**
 * User: mazasb
 * Date: 2016. 06. 03.
 * Time: 13:28
 */

namespace Acme\JwtAuthBundle\src\Token;

use Acme\JwtAuthBundle\Payload;

interface Storage
{
    /**
     * @param Payload $payload
     */
    public function store(Payload $payload);
}