<?php
/**
 * User: mazasb
 * Date: 2016. 06. 03.
 * Time: 10:33
 */

namespace Acme\JwtAuthBundle\Claim;

class Factory
{
    /**
     * @var array
     */
    protected $map = [
        'jti' => IssuedAt::class,
        'exp' => Expiration::class
    ];

    /**
     * @param string $name
     * @param mixed $value
     * @return Claim
     */
    public function createClaim($name, $value)
    {
        if (array_key_exists($name, $this->map))
        {
            return $this->map[$name]($value);
        }

        return new Custom($name, $value);
    }
}