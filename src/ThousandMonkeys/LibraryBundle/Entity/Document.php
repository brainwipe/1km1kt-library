<?php
namespace ThousandMonkeys\LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Document
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $name;

	/**
     * @ORM\OneToMany(targetEntity="Version", mappedBy="document", cascade={"persist"})
     */
	protected $versions;

    /**
     * @ORM\ManyToOne(targetEntity="Game", inversedBy="documents")
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id")
     * @Assert\Type(type="ThousandMonkeys\LibraryBundle\Entity\Game")
     */
    protected $game;

	public function __construct()
    {
        $this->versions = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Document
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add versions
     *
     * @param ThousandMonkeys\LibraryBundle\Entity\Version $versions
     * @return Document
     */
    public function addVersion(\ThousandMonkeys\LibraryBundle\Entity\Version $versions)
    {
        $this->versions[] = $versions;
    
        return $this;
    }

    /**
     * Remove versions
     *
     * @param ThousandMonkeys\LibraryBundle\Entity\Version $versions
     */
    public function removeVersion(\ThousandMonkeys\LibraryBundle\Entity\Version $versions)
    {
        $this->versions->removeElement($versions);
    }

    /**
     * Get versions
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getVersions()
    {
        return $this->versions;
    }

    /**
     * Set game
     *
     * @param ThousandMonkeys\LibraryBundle\Entity\Game $game
     * @return Document
     */
    public function setGame(\ThousandMonkeys\LibraryBundle\Entity\Game $game = null)
    {
        $this->game = $game;
    
        return $this;
    }

    /**
     * Get game
     *
     * @return ThousandMonkeys\LibraryBundle\Entity\Game 
     */
    public function getGame()
    {
        return $this->game;
    }
}