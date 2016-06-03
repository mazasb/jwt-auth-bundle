<?php
/**
 * User: mazasb
 * Date: 2016. 06. 03.
 * Time: 11:44
 */

namespace Acme\JwtAuthBundle\Tests;

use Acme\JwtAuthBundle\Payload\Claim\Custom;
use Acme\JwtAuthBundle\Payload\Claim\Expiration;

class ClaimTest extends \PHPUnit_Framework_TestCase
{
    public function testCustomClaim()
    {
        $claim = Expiration::create(new \DateTime('+1 month'));
        $customClaim = new Custom('name', 'value');
    }
}