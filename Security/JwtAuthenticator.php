<?php
/**
 * User: mazasb
 * Date: 2016. 06. 07.
 * Time: 9:52
 */

namespace Acme\JwtAuthBundle\Security;

use Acme\JwtAuthBundle\Security\Provider\ITokenUserProvider;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Http\Authentication\SimplePreAuthenticatorInterface;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\JWT;

class JwtAuthenticator implements SimplePreAuthenticatorInterface, AuthenticationFailureHandlerInterface
{
    /**
     * @var JWT
     */
    private $jwt;

    /**
     * @param JWT $jwt
     */
    public function __construct(JWT $jwt)
    {
        $this->jwt = $jwt;
    }

    public function createToken(Request $request, $providerKey)
    {
        if (!$token = $this->jwt->parseToken()->getToken()) {
            throw new BadCredentialsException('No JWT token found');

            // or to just skip api key authentication
            // return null;
        }

        return new PreAuthenticatedToken(
            'anon.',
            $token,
            $providerKey
        );
    }

    public function authenticateToken(TokenInterface $token, UserProviderInterface $userProvider, $providerKey)
    {
        if (!$userProvider instanceof ITokenUserProvider)
        {
            throw new \InvalidArgumentException(
                sprintf(
                    'The user provider must be an instance of %s (%s was given).',
                    ITokenUserProvider::class, get_class($userProvider)
                )
            );
        }

        $jwtToken = $token->getCredentials();
        try
        {
            $payload = $this->jwt
                ->setToken($jwtToken)
                ->getPayload()
            ;
        }
        catch (TokenExpiredException $e)
        {
            throw new CustomUserMessageAuthenticationException('Token is expired.');
        }
        catch (TokenInvalidException $e)
        {
            throw new CustomUserMessageAuthenticationException('Token is invalid.');
        }

        $user = $userProvider->getUserByPayload($payload);

        return new PreAuthenticatedToken(
            $user,
            $jwtToken,
            $providerKey,
            $user->getRoles()
        );
    }

    public function supportsToken(TokenInterface $token, $providerKey)
    {
        return $token instanceof PreAuthenticatedToken && $token->getProviderKey() === $providerKey;
    }

    /**
     * @inheritDoc
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $data = [
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())
            // $this->translator->trans($exception->getMessageKey(), $exception->getMessageData())
        ];

        return new JsonResponse($data, JsonResponse::HTTP_UNAUTHORIZED);
    }
}