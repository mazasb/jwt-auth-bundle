<?php
/**
 * User: mazasb
 * Date: 2016. 06. 07.
 * Time: 13:10
 */

namespace Acme\JwtAuthBundle\Security\Provider;

use Tymon\JWTAuth\Contracts\Providers\Storage;

class Blacklist implements Storage
{
    /**
     * @inheritDoc
     */
    public function add($key, $value, $minutes)
    {
        // TODO: Implement add() method.
        throw new \Exception(__METHOD__.' not implemented.');
    }

    /**
     * @inheritDoc
     */
    public function forever($key, $value)
    {
        // TODO: Implement forever() method.
        throw new \Exception(__METHOD__.' not implemented.');
    }

    /**
     * @inheritDoc
     */
    public function get($key)
    {
        // TODO: Implement get() method.
        throw new \Exception(__METHOD__.' not implemented.');
    }

    /**
     * @inheritDoc
     */
    public function destroy($key)
    {
        // TODO: Implement destroy() method.
        throw new \Exception(__METHOD__.' not implemented.');
    }

    /**
     * @inheritDoc
     */
    public function flush()
    {
        // TODO: Implement flush() method.
        throw new \Exception(__METHOD__.' not implemented.');
    }
}