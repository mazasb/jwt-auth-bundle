<?php
/**
 * User: mazasb
 * Date: 2016. 06. 03.
 * Time: 9:50
 */

namespace Acme\JwtAuthBundle\Payload\Claim;

use Acme\JwtAuthBundle\Util\DateHelper;

class Expiration extends Claim
{
    use DateTimeCreatorTrait;

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'exp';
    }

    /**
     * @inheritDoc
     */
    protected function validateValue()
    {
        if (DateHelper::isPast($this->getValue()))
        {
            throw new \RuntimeException('Token is expired.');
        }
    }
}