<?php
namespace ThousandMonkeys\LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Role
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\Column(type="string", length=256)
	 */
	protected $description;

	/**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="roles")
     * @ORM\JoinTable(name="user_role")
     */
	protected $users;

	public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Role
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add users
     *
     * @param ThousandMonkeys\LibraryBundle\Entity\User $users
     * @return Role
     */
    public function addUser(\ThousandMonkeys\LibraryBundle\Entity\User $users)
    {
        $this->users[] = $users;
    
        return $this;
    }

    /**
     * Remove users
     *
     * @param ThousandMonkeys\LibraryBundle\Entity\User $users
     */
    public function removeUser(\ThousandMonkeys\LibraryBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}