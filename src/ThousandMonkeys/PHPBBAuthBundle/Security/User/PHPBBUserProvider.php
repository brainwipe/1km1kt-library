<?php
namespace ThousandMonkeys\PHPBBAuthBundle\Security\User;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class PHPBBUserProvider implements UserProviderInterface
{
    private $container;

    public function __construct(Container $container) {
        $this->container = $container;
    }

	public function loadUserByUsername($username)
    {
        PHPBBIntegration::Setup(
            $this->container->getParameter('phpbb_forum_url'),
            $this->container->getParameter('phpbb_fourm_path'),
            $this->container->getParameter('phpbb_db_server'),
            $this->container->getParameter('phpbb_db_catalog'),
            $this->container->getParameter('phpbb_db_user'),
            $this->container->getParameter('phpbb_db_password'),
            $this->container->getParameter('phpbb_db_prefix')
            );

		$user_id = PHPBBIntegration::getLoggedInUserId();

        if ($user_id > 0) {

            $user_info = PHPBBIntegration::getUserInformation($user_id);
            $roles = PHPBBIntegration::getUserRoles($user_id);

            return new PHPBBUser($user_id, $user_info['username'], $roles, $user_info['email'], $user_info['avatar']);
        }

        throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof PHPBBUser) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === 'ThousandMonkeys\PHPBBAuthBundle\Security\User\PHPBBUser';
    }
}