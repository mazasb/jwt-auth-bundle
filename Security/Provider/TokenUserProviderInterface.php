<?php
/**
 * User: mazasb
 * Date: 2016. 06. 07.
 * Time: 10:32
 */

namespace Acme\JwtAuthBundle\Security\Provider;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Tymon\JWTAuth\Payload;

interface TokenUserProviderInterface extends UserProviderInterface
{
    /**
     * @param Payload $payload
     * @return UserInterface
     */
    public function getUserByPayload(Payload $payload);
}
