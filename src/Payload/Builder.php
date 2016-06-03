<?php
/**
 * User: mazasb
 * Date: 2016. 06. 03.
 * Time: 13:48
 */

namespace Acme\JwtAuthBundle\Payload;

use Acme\JwtAuthBundle\Claim\Collection;
use Acme\JwtAuthBundle\Claim\Factory as ClaimFactory;
use Acme\JwtAuthBundle\Payload;

class Builder
{
    /**
     * @var ClaimFactory
     */
    protected $claimFactory;

    /**
     * @var Collection
     */
    protected $claims;

    /**
     * @var array
     */
    protected $defaultClaims = ['iat', 'exp', 'jti'];

    /**
     * @var array
     */
    protected $requiredClaims;

    /**
     * @var int
     */
    protected $ttl = 60;

    /**
     * @param ClaimFactory $claimFactory
     * @param array $requiredClaims
     */
    public function __construct(ClaimFactory $claimFactory, array $requiredClaims = [])
    {
        $this->claims = new Collection();
        $this->claimFactory = $claimFactory;
        $this->requiredClaims = $requiredClaims;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function addClaim($name, $value)
    {
        $this->claims[] = $this->claimFactory->createClaim($name, $value);
    }

    /**
     * @param array $claims Key and value pairs
     */
    public function addClaims(array $claims)
    {
        foreach ($claims as $name => $value)
        {
            $this->addClaim($name, $value);
        }
    }

    /**
     * @return Payload
     */
    public function build()
    {
        foreach ($this->defaultClaims as $claim)
        {
            $this->addClaim($claim, $this->$claim());
        }

        $payload = new Payload($this->claims, $this->requiredClaims);
        $this->claims = new Collection();

        return $payload;
    }

    /**
     * @return array
     */
    public function getRequiredClaims()
    {
        return $this->requiredClaims;
    }
}