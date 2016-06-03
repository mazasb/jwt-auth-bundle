<?php
/**
 * User: mazasb
 * Date: 2016. 06. 03.
 * Time: 8:26
 */

namespace Acme\JwtAuthBundle\Claim;

abstract class Claim
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;

        $this->validateName();
        $this->validateValue();
    }

    /**
     * @param $name
     */
    private function validateName()
    {
        $name = $this->getName();
        if (empty($name))
        {
            throw new \RuntimeException('Claim name must be set and not empty.');
        }
        if (!is_string($name))
        {
            throw new \UnexpectedValueException('Claim name must be string.');
        }
    }

    abstract protected function validateValue();

    /**
     * @return string
     */
    abstract public function getName();

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}