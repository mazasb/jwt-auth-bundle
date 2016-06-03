<?php
/**
 * User: mazasb
 * Date: 2016. 06. 03.
 * Time: 13:16
 */

namespace Acme\JwtAuthBundle\Token;

use Acme\JwtAuthBundle\Payload\Builder as PayloadBuilder;

class Manager
{
    /**
     * @var Provider
     */
    private $provider;

    /**
     * @var PayloadBuilder
     */
    private $payloadBuilder;

    /**
     * @param Provider $provider
     * @param PayloadBuilder $payloadBuilder
     */
    public function __construct(Provider $provider, PayloadBuilder $payloadBuilder)
    {
        $this->provider = $provider;
        $this->payloadBuilder = $payloadBuilder;
    }
}
