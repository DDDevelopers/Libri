<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ShelfRepository")
 * @ORM\Table(name="shelf")
 */
class Shelf
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $name;
    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;
    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\UserBookShelf", mappedBy="shelf")
     */
    private $usersBooks;
    /**
     * @ORM\Column(type="integer")
     */
    private $order;

    public function __construct()
    {
        if(!$this->getCreatedAt()) {
            $this->createdAt = new \DateTime();
        }
        $this->updatedAt = new \DateTime();
    }
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }


    /**
     * Add usersBook
     *
     * @param \AppBundle\Entity\UserBookShelf $usersBook
     *
     * @return Shelf
     */
    public function addUsersBook(\AppBundle\Entity\UserBookShelf $usersBook)
    {
        $this->usersBooks[] = $usersBook;

        return $this;
    }

    /**
     * Remove usersBook
     *
     * @param \AppBundle\Entity\UserBookShelf $usersBook
     */
    public function removeUsersBook(\AppBundle\Entity\UserBookShelf $usersBook)
    {
        $this->usersBooks->removeElement($usersBook);
    }

    /**
     * Get usersBooks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsersBooks()
    {
        return $this->usersBooks;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }


}
