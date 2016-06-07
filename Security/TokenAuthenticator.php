<?php
/**
 * User: mazasb
 * Date: 2016. 06. 07.
 * Time: 8:46
 */

namespace Acme\JwtAuthBundle\Security;

use Acme\JwtAuthBundle\Security\Provider\ITokenUserProvider;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\JWT;

class TokenAuthenticator extends AbstractGuardAuthenticator
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

    /**
     * @inheritDoc
     */
    public function getCredentials(Request $request)
    {
        try
        {
            $token = $this->jwt->parseToken()->getToken();
        }
        catch (JWTException $e)
        {
            return null;
        }

        try
        {
            $payload = $this->jwt->getPayload();
        }
        catch (TokenExpiredException $e)
        {
            throw new CustomUserMessageAuthenticationException('Token is expired.');
        }
        catch (TokenInvalidException $e)
        {
            throw new CustomUserMessageAuthenticationException('Token is invalid.');
        }

        return [
            'token' => $token,
            'payload' => $payload
        ];
    }

    /**
     * @inheritDoc
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
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

        return $userProvider->getUserByPayload($credentials['payload']);
    }

    /**
     * @inheritDoc
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return;
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

    /**
     * @inheritDoc
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        $data = [
            'message' => 'Authentication Required'
        ];

        return new JsonResponse($data, JsonResponse::HTTP_UNAUTHORIZED);
    }

    /**
     * @inheritDoc
     */
    public function supportsRememberMe()
    {
        return false;
    }
}
