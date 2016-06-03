<?php
/**
 * User: mazasb
 * Date: 2016. 06. 03.
 * Time: 13:23
 */

namespace Acme\JwtAuthBundle\Token;

interface Provider
{
    /**
     * @param array $payload
     * @return string $token
     */
    public function encode(array $payload);

    /**
     * @param string $token
     * @return array $payload
     */
    public function decode($token);
}
