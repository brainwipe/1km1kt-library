<?php
namespace ThousandMonkeys\LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class User
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
	protected $forumId;


	/**
     * @ORM\ManyToMany(targetEntity="Role", mappedBy="users")
     */
	protected $roles;

	public function __construct()
    {
        $this->roles = new ArrayCollection();
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
     * Set forumId
     *
     * @param string $forumId
     * @return User
     */
    public function setForumId($forumId)
    {
        $this->forumId = $forumId;
    
        return $this;
    }

    /**
     * Get forumId
     *
     * @return string 
     */
    public function getForumId()
    {
        return $this->forumId;
    }

    /**
     * Add roles
     *
     * @param ThousandMonkeys\LibraryBundle\Entity\Role $roles
     * @return User
     */
    public function addRole(\ThousandMonkeys\LibraryBundle\Entity\Role $roles)
    {
        $this->roles[] = $roles;
    
        return $this;
    }

    /**
     * Remove roles
     *
     * @param ThousandMonkeys\LibraryBundle\Entity\Role $roles
     */
    public function removeRole(\ThousandMonkeys\LibraryBundle\Entity\Role $roles)
    {
        $this->roles->removeElement($roles);
    }

    /**
     * Get roles
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getRoles()
    {
        return $this->roles;
    }
}