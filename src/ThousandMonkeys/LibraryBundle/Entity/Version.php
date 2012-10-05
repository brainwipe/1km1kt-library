<?php
namespace ThousandMonkeys\LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Version
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
	protected $versionName;

	/**
	 * @ORM\Column(type="string", length=512)
	 */
	protected $fileURL;

	/**
	 * @ORM\Column(type="integer")
	 */
	protected $uploadedByUserId;

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
     * Set versionName
     *
     * @param string $versionName
     * @return Version
     */
    public function setVersionName($versionName)
    {
        $this->versionName = $versionName;
    
        return $this;
    }

    /**
     * Get versionName
     *
     * @return string 
     */
    public function getVersionName()
    {
        return $this->versionName;
    }

    /**
     * Set fileURL
     *
     * @param string $fileURL
     * @return Version
     */
    public function setFileURL($fileURL)
    {
        $this->fileURL = $fileURL;
    
        return $this;
    }

    /**
     * Get fileURL
     *
     * @return string 
     */
    public function getFileURL()
    {
        return $this->fileURL;
    }

    /**
     * Set uploadedByUserId
     *
     * @param integer $uploadedByUserId
     * @return Version
     */
    public function setUploadedByUserId($uploadedByUserId)
    {
        $this->uploadedByUserId = $uploadedByUserId;
    
        return $this;
    }

    /**
     * Get uploadedByUserId
     *
     * @return integer 
     */
    public function getUploadedByUserId()
    {
        return $this->uploadedByUserId;
    }
}