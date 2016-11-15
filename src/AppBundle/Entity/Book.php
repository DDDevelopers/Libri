<?php
namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BookRepository")
 * @ORM\Table(name="book")
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", unique=false)
     * @Assert\NotBlank()
     */
    private $title;
    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $description;
    /**
     * @Assert\NotBlank()
     * @Assert\Range(min=0, minMessage="Negative number ..! C'mon give me a real number.")
     * @ORM\Column(type="integer")
     */
    private $pages;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Author", inversedBy="books")
     * @Assert\NotBlank()
     */
    private $author;
    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;
    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;
    /**
     * @var
     * @ORM\Column(type="date", nullable=true)
     * @Assert\NotBlank()
     */
    private $publishedAt;
    /**
     * @var
     * @ORM\Column(name="is_for_sale", type="boolean")
     */
    private $isForSale = 0;
    /**
     * @var
     * @ORM\Column(name="is_for_exchange", type="boolean")
     */
    private $isForExchange = 0;
    /**
     * @ORM\Column(name="peaces_in_shelf", type="integer")
     */
    private $peacesInShelf = 0;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Review", mappedBy="book")
     */
    private $reviews;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\UserBookShelf", mappedBy="book")
     */
    private $usersShelfed;

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Please add a cover for this book.")
     */
    private $cover;

    public function getCover()
    {
        return $this->cover;
    }

    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
    }

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->reviews = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @param mixed $publishedAt
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;
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
     * Set title
     *
     * @param string $title
     *
     * @return Book
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
     * Set description
     *
     * @param string $description
     *
     * @return Book
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
     * Set pages
     *
     * @param integer $pages
     *
     * @return Book
     */
    public function setPages($pages)
    {
        $this->pages = $pages;

        return $this;
    }

    /**
     * Get pages
     *
     * @return integer
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Book
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Book
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
     * Set author
     *
     * @param \AppBundle\Entity\Author $author
     *
     * @return Book
     */
    public function setAuthor(\AppBundle\Entity\Author $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \AppBundle\Entity\Author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set isForSale
     *
     * @param boolean $isForSale
     *
     * @return Book
     */
    public function setIsForSale($isForSale)
    {
        $this->isForSale = $isForSale;

        return $this;
    }

    /**
     * Get isForSale
     *
     * @return boolean
     */
    public function getIsForSale()
    {
        return $this->isForSale;
    }

    /**
     * Set isForExchange
     *
     * @param boolean $isForExchange
     *
     * @return Book
     */
    public function setIsForExchange($isForExchange)
    {
        $this->isForExchange = $isForExchange;

        return $this;
    }

    /**
     * Get isForExchange
     *
     * @return boolean
     */
    public function getIsForExchange()
    {
        return $this->isForExchange;
    }

    /**
     * Set peacesInShelf
     *
     * @param integer $peacesInShelf
     *
     * @return Book
     */
    public function setPeacesInShelf($peacesInShelf)
    {
        $this->peacesInShelf = $peacesInShelf;

        return $this;
    }

    /**
     * Get peacesInShelf
     *
     * @return integer
     */
    public function getPeacesInShelf()
    {
        return $this->peacesInShelf;
    }
    /**
     * Add review
     *
     * @param \AppBundle\Entity\Review $review
     *
     * @return Book
     */
    public function addReview(\AppBundle\Entity\Review $review)
    {
        $this->reviews[] = $review;

        return $this;
    }

    /**
     * Remove review
     *
     * @param \AppBundle\Entity\Review $review
     */
    public function removeReview(\AppBundle\Entity\Review $review)
    {
        $this->reviews->removeElement($review);
    }

    /**
     * Get reviews
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * Add usersShelfed
     *
     * @param \AppBundle\Entity\UserBookShelf $usersShelfed
     *
     * @return Book
     */
    public function addUsersShelfed(\AppBundle\Entity\UserBookShelf $usersShelfed)
    {
        $this->usersShelfed[] = $usersShelfed;

        return $this;
    }

    /**
     * Remove usersShelfed
     *
     * @param \AppBundle\Entity\UserBookShelf $usersShelfed
     */
    public function removeUsersShelfed(\AppBundle\Entity\UserBookShelf $usersShelfed)
    {
        $this->usersShelfed->removeElement($usersShelfed);
    }

    /**
     * Get usersShelfed
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsersShelfed()
    {
        return $this->usersShelfed;
    }
}
