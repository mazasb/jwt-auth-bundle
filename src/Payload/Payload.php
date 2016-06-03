<?php
/**
 * User: mazasb
 * Date: 2016. 06. 03.
 * Time: 8:32
 */

namespace Acme\JwtAuthBundle;

use Acme\JwtAuthBundle\Claim\Collection;

class Payload
{
    /**
     * @var Collection
     */
    protected $claims;

    /**
     * @var array
     */
    protected $requiredClaims;

    /**
     * @param Collection $claims
     * @param array $requiredClaims
     */
    public function __construct(Collection $claims, array $requiredClaims = [])
    {
        $this->claims = clone $claims;
        $this->requiredClaims = $requiredClaims;

        $this->checkRequiredClaims();
    }

    /**
     * @throws \RuntimeException
     */
    protected function checkRequiredClaims()
    {
        $missingClaims = array_diff($this->requiredClaims, array_keys($this->claims->toArray()));
        if (count($missingClaims) !== 0)
        {
            throw new \RuntimeException(
                sprintf('JWT payload not contain the required claims. Missing claims: %s', implode(', ', $missingClaims))
            );
        }
    }

    /**
     * @return Collection
     */
    public function getClaims()
    {
        return $this->claims;
    }

    /**
     * @return array
     */
    public function getRequiredClaims()
    {
        return $this->requiredClaims;
    }
}
