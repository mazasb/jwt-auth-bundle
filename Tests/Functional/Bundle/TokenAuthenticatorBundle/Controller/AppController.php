<?php
/**
 * User: mazasb
 * Date: 2016. 06. 07.
 * Time: 13:18
 */

namespace Acme\JwtAuthBundle\Tests\Functional\Bundle\TokenAuthenticatorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AppController extends Controller
{
    public function securedAction(Request $request)
    {
        return new Response('Secured area.');
    }

    public function unsecuredAction(Request $request)
    {
        return new Response('Unsecured area.');
    }
}