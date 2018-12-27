<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;



/**
 * Tickets
 *
 * @ORM\Table(name="tickets")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TicketsRepository")
 */
class Tickets
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="edited_at", type="datetime")
     */
    private $editedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="priority", type="string", length=255, nullable=true)
     */
    private $priority;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="boolean", options={"default": false}, nullable=true)
     */
    private $state;


    /**
     * @var string
     *
     * @ORM\Column(name="problem", type="string", length=255, nullable=true)
     */
    private $problem;

    /**
     * @ORM\Column(name="updated_at", type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;
    
    
    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Image", mappedBy="ticketImage", cascade={"persist"})
     *
     */
    private $images = null;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="tickets", cascade={"persist", "merge", "remove"}, fetch="EAGER")
     *
     */
    private $users;
    
    
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->editedAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->images = new ArrayCollection();
    }
    
    public function __toString()
    {
        return $this->title;
    }
    
    /**
     * Add image
     *
     * @param \AppBundle\Entity\Image $image
     *
     * @return Tickets
     */
    public function addImage(\AppBundle\Entity\Image $image)
    {
        $image->setTicketImage($this);
        $this->images->add($image);

    }
    
//    public function addImage(Image $image)
//    {
//        $this->images[] = $image;
//        $image->setTicketImage($this);
//        $this->images->add($image);
//    }

    /**
     * Remove image
     *
     * @param \AppBundle\Entity\Image $image
     */
    public function removeImage(\AppBundle\Entity\Image $image)
    {
        $this->images->removeElement($image);
    }
    
    /**
     * set images
     *
     * @param \AppBundle\Entity\Image $image
     *
     * @return Tickets
     */
    public function setImages(\AppBundle\Entity\Image $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Get images
     *
     * @return \AppBundle\Entity\Image
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set title
     *
     * @param string $title
     *
     * @return Tickets
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Tickets
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set editedAt
     *
     * @param \DateTime $editedAt
     *
     * @return Tickets
     */
    public function setEditedAt($editedAt)
    {
        $this->editedAt = $editedAt;

        return $this;
    }

    /**
     * Get editedAt
     *
     * @return \DateTime
     */
    public function getEditedAt()
    {
        return $this->editedAt;
    }

    /**
     * Set priority
     *
     * @param string $priority
     *
     * @return Tickets
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return Tickets
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }


    /**
     * Set problem
     *
     * @param string $problem
     *
     * @return Tickets
     */
    public function setProblem($problem)
    {
        $this->problem = $problem;

        return $this;
    }

    /**
     * Get problem
     *
     * @return string
     */
    public function getProblem()
    {
        return $this->problem;
    }
    
    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Tickets
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Tickets
     */
    public function addUser(\AppBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\User $user
     */
    public function removeUser(\AppBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set users
     *
     * @param \AppBundle\Entity\User $users
     *
     * @return Tickets
     */
    public function setUsers(\AppBundle\Entity\User $users = null)
    {
        $this->users = $users;

        return $this;
    }
}
