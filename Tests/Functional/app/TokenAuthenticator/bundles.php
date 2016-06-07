<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Acme\JwtAuthBundle\JwtAuthBundle;
use Acme\JwtAuthBundle\Tests\Functional\Bundle\TokenAuthenticatorBundle\TokenAuthenticatorBundle;
use Symfony\Bundle\SecurityBundle\SecurityBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;

return array(
    new FrameworkBundle(),
    new SecurityBundle(),
    new JwtAuthBundle(),
    new TokenAuthenticatorBundle(),
);
