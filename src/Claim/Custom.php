<?php
/**
 * User: mazasb
 * Date: 2016. 06. 03.
 * Time: 10:41
 */

namespace Acme\JwtAuthBundle\Claim;

class Custom extends Claim
{
    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __construct($name, $value)
    {
        $this->name = $name;
        parent::__construct($value);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    protected function validateValue()
    {
    }
}
