<?php
/**
 * User: mazasb
 * Date: 2016. 06. 03.
 * Time: 8:26
 */

namespace Acme\JwtAuthBundle\Payload\Claim;

use Doctrine\Common\Collections\ArrayCollection;

class Collection extends ArrayCollection
{
    /**
     * @inheritDoc
     */
    public function __construct(array $claims)
    {
        foreach ($claims as $claim)
        {
            $this->validate($claim);
        }

        parent::__construct($claims);
    }

    /**
     * @inheritDoc
     */
    public function add($claim)
    {
        $this->validate($claim);

        return parent::add($claim);
    }

    /**
     * @inheritDoc
     */
    public function set($key, $claim)
    {
        $this->validate($claim);

        parent::set($key, $claim);
    }

    /**
     * @param $claim
     */
    protected function validate($claim)
    {
        if (!$claim instanceof Claim)
        {
            throw new \UnexpectedValueException(sprintf('Claim in collection must be instance of %s', Claim::class));
        }
    }
}
