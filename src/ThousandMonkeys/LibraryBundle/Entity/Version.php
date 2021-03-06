<?php
namespace ThousandMonkeys\LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Version
{
    /**
     * @Assert\File(maxSize="6000000")
     * @Assert\NotNull()
     */
    public $file;

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
	protected $fileName;

    /**
     * @ORM\Column(type="string", length=512)
     */
    protected $absoluteFileDirPath;

    /**
     * @ORM\Column(type="string", length=512)
     */
    protected $webFileDirPath;

	/**
	 * @ORM\Column(type="integer")
	 */
	protected $uploadedByUserId;

    /**
     * @ORM\ManyToOne(targetEntity="Document", inversedBy="versions")
     * @ORM\JoinColumn(name="document_id", referencedColumnName="id")
     * @Assert\Type(type="ThousandMonkeys\LibraryBundle\Entity\Document")     
     */
    protected $document;

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

    /**
     * Set fileName
     *
     * @param string $fileName
     * @return Version
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    
        return $this;
    }

    /**
     * Get fileName
     *
     * @return string 
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set absoluteFileDirPath
     *
     * @param string $absoluteFileDirPath
     * @return Version
     */
    public function setAbsoluteFileDirPath($absoluteFileDirPath)
    {
        $this->absoluteFileDirPath = $absoluteFileDirPath;
    
        return $this;
    }

    /**
     * Get absoluteFileDirPath
     *
     * @return string 
     */
    public function getAbsoluteFileDirPath()
    {
        return $this->absoluteFileDirPath;
    }

    /**
     * Set webFileDirPath
     *
     * @param string $webFileDirPath
     * @return Version
     */
    public function setWebFileDirPath($webFileDirPath)
    {
        $this->webFileDirPath = $webFileDirPath;
    
        return $this;
    }

    /**
     * Get webFileDirPath
     *
     * @return string 
     */
    public function getWebFileDirPath()
    {
        return $this->webFileDirPath;
    }

    /**
     * Gets the actual path to the file on the server. From the point of view of the code, not the end user. 
     * Use this one for moving/modifying files
     *
     * @return string
    */
    public function getAbsoluteFilePath()
    {
        return $this->absoluteFileDirPath . '/' . $this->fileName;
    }

    /**
     * Gets the path to the file from the web context. This is the url that the browser will use.
     *
     * @return string
    */
    public function getWebFilePath()
    {
        return $this->webFileDirPath . '/' . $this->fileName;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            $this->fileName = date('YmdHis') . '_' . $this->file->getClientOriginalName();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }

        $this->file->move($this->getAbsoluteFileDirPath(), $this->fileName);

        unset($this->file);
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file == $this->getAbsoluteFilePath()) {
            unlink($file);
        }
    }


    /**
     * Set document
     *
     * @param ThousandMonkeys\LibraryBundle\Entity\Document $document
     * @return Version
     */
    public function setDocument(\ThousandMonkeys\LibraryBundle\Entity\Document $document = null)
    {
        $this->document = $document;
    
        return $this;
    }

    /**
     * Get document
     *
     * @return ThousandMonkeys\LibraryBundle\Entity\Document 
     */
    public function getDocument()
    {
        return $this->document;
    }
}