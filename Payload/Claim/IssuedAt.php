<?php
/**
 * User: mazasb
 * Date: 2016. 06. 03.
 * Time: 10:25
 */

namespace Acme\JwtAuthBundle\Payload\Claim;

use Acme\JwtAuthBundle\Util\DateHelper;

class IssuedAt extends Claim
{
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'iat';
    }

    /**
     * @inheritDoc
     */
    protected function validateValue()
    {
        if (!DateHelper::isPast($this->getValue()))
        {
            throw new \RuntimeException('Issued at date is the future date.');
        }
    }
}