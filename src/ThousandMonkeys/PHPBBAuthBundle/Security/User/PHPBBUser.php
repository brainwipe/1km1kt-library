<?php
namespace ThousandMonkeys\PHPBBAuthBundle\Security\User;

use Symfony\Component\Security\Core\User\UserInterface;

class PHPBBUser implements UserInterface
{
    private $id;
	private $username;
    private $password;
    private $salt;
    private $roles;
    private $email;
    private $avatar;

    public function __construct($id, $username, array $roles, $email, $avatar)
    {
        $this->id = $id;
        $this->username = $username;
        $this->roles = $roles;
        $this->email = $email;
        $this->avatar = $avatar;

        // We do not use these, they remain in the phpbb 
        $this->password = 'DUMMYNOTUSED';
        $this->salt = '';
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }    

    public function getRoles()
    {
        return $this->roles;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function eraseCredentials()
    {
    }

    public function equals(UserInterface $user)
    {
        if (!$user instanceof WebserviceUser) {
            return false;
        }

        if ($this->password !== $user->getPassword()) {
            return false;
        }

        if ($this->getSalt() !== $user->getSalt()) {
            return false;
        }

        if ($this->username !== $user->getUsername()) {
            return false;
        }

        return true;
    }
}