<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ImageRepository")
 * @Vich\Uploadable
 */
class Image
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="tickets", fileNameProperty="imageName")
     * 
     * @var File
     */
    private $imageFile;

    /**
     * @var string
     *
     * @ORM\Column(name="imageName", type="string", length=255, nullable=true)
     */
    private $imageName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Tickets", inversedBy="images", cascade={"persist", "merge", "remove"})
     * @ORM\JoinColumn(name="ticket_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $ticketImage = null;
    
    public function __construct()
    {
        $this->updatedAt = new \DateTime();

    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set imageFile.
     *
     * @param string|null $imageFile
     *
     * @return Image
     */
    public function setImageFile($imageFile = null)
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    /**
     * Get imageFile.
     *
     * @return string|null
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Set imageName.
     *
     * @param string $imageName
     *
     * @return Image
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get imageName.
     *
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set updatedAt.
     *
     * @param \DateTime $updatedAt
     *
     * @return Image
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set ticketImage.
     *
     * @param \AppBundle\Entity\Tickets|null $ticketImage
     *
     * @return Image
     */
    public function setTicketImage(\AppBundle\Entity\Tickets $ticketImage = null)
    {
        $this->ticketImage = $ticketImage;

        return $this;
    }

    /**
     * Get ticketImage.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTicketImage()
    {
        return $this->ticketImage;
    }
}
