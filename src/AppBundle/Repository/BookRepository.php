<?php
namespace AppBundle\Repository;


use AppBundle\Entity\Book;
use Doctrine\ORM\EntityRepository;

class BookRepository extends EntityRepository
{

    public function searchAllBooks($query = null)
    {
        $q = $this->createQueryBuilder('book');

        return $q->getQuery()->getResult();
    }

    /**
     * @param $title
     * @return Book|null
     */
    public function findBookByTitle($title)
    {
        $q = $this->createQueryBuilder('book')
            ->where('book.title = :title')
            ->setParameter('title', $title)
            ->orderBy('book.title', 'ASC');

        return $q->getQuery()->getOneOrNullResult();
    }
}