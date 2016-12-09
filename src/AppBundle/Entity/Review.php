<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="review")
 */
class Review
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rating;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $review;
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $startedReading;
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $finishedReading;
    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;
    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Book", inversedBy="reviews")
     */
    private $book;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="reviews")
     */
    private $user;

    public function __construct()
    {
        if (!$this->getCreatedAt()) {
            $this->createdAt = new \DateTime();
        }
        $this->updatedAt = new \DateTime();
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
     * Set rating
     *
     * @param integer $rating
     *
     * @return Review
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set review
     *
     * @param string $review
     *
     * @return Review
     */
    public function setReview($review)
    {
        $this->review = $review;

        return $this;
    }

    /**
     * Get review
     *
     * @return string
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * Set startedReading
     *
     * @param \DateTime $startedReading
     *
     * @return Review
     */
    public function setStartedReading($startedReading)
    {
        $this->startedReading = \DateTime::createFromFormat('d.m.Y', $startedReading);
        return $this;
    }

    /**
     * Get startedReading
     *
     * @return \DateTime
     */
    public function getStartedReading()
    {
        return $this->startedReading;
    }

    /**
     * Set finishedReading
     *
     * @param \DateTime $finishedReading
     *
     * @return Review
     */
    public function setFinishedReading($finishedReading)
    {
        $this->finishedReading = \DateTime::createFromFormat('d.m.Y', $finishedReading);

        return $this;
    }

    /**
     * Get finishedReading
     *
     * @return \DateTime
     */
    public function getFinishedReading()
    {
        return $this->finishedReading;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Review
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
     * @return Review
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
     * Set book
     *
     * @param \AppBundle\Entity\Book $book
     *
     * @return Review
     */
    public function setBook(Book $book = null)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book
     *
     * @return \AppBundle\Entity\Book
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Review
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
