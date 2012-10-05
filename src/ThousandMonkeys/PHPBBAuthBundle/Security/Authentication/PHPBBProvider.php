<?php
namespace ThousandMonkeys\PHPBBAuthBundle\Security\Authentication;

use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\NonceExpiredException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

use ThousandMonkeys\PHPBBAuthBundle\Security\Authentication\PHPBBToken;

class PHPBBProvider implements AuthenticationProviderInterface
{
    private $userProvider;
    private $cacheDir;

    public function __construct(UserProviderInterface $userProvider, $cacheDir)
    {
        $this->userProvider = $userProvider;
        $this->cacheDir     = $cacheDir;
    }

    public function authenticate(TokenInterface $token)
    {
        $user = $this->userProvider->loadUserByUsername("DUMMYNOTUSED");

        $authenticatedToken = new PHPBBToken($user->getRoles());
        $authenticatedToken->setUser($user);

        return $authenticatedToken;
    }

    public function supports(TokenInterface $token)
    {
        return $token instanceof PHPBBToken;
    }
}