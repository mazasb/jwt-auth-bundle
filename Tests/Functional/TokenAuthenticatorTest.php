<?php

namespace Acme\JwtAuthBundle\Tests\Functional;

use Symfony\Component\HttpFoundation\Response;

class TokenAuthenticatorTest extends WebTestCase
{
    public function testRequestUnsecuredArea_WithoutToken()
    {
        $client = $this->createClient(['test_case' => 'TokenAuthenticator']);

        $client->request('GET', '/unprotected_resource');
        $response = $client->getResponse();

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public function testRequestSecuredArea_WithoutToken()
    {
        $client = $this->createClient(['test_case' => 'TokenAuthenticator']);

        $client->request('GET', '/secure/resource');
        $response = $client->getResponse();

        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
        $this->assertEquals('Authentication Required', json_decode($response->getContent(), true)['message']);
    }

    public static function setUpBeforeClass()
    {
        parent::deleteTmpDir('TokenAuthenticator');
    }

    public static function tearDownAfterClass()
    {
        parent::deleteTmpDir('TokenAuthenticator');
    }
}
