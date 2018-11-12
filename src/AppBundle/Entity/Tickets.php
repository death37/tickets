<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="request", type="string", length=255)
     */
    private $request;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
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
     * @ORM\Column(name="priority", type="string", length=255)
     */
    private $priority;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="boolean", options={"default": false})
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255)
     */
    private $picture;

    /**
     * @var string
     *
     * @ORM\Column(name="problem", type="string", length=255)
     */
    private $problem;


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
     * Set request
     *
     * @param string $request
     *
     * @return Tickets
     */
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * Get request
     *
     * @return string
     */
    public function getRequest()
    {
        return $this->request;
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
     * Set picture
     *
     * @param string $picture
     *
     * @return Tickets
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
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
}
