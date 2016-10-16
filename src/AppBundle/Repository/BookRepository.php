<?php
namespace AppBundle\Repository;


use AppBundle\Entity\Book;
use Doctrine\ORM\EntityRepository;

class BookRepository extends EntityRepository
{

    public function searchAllBooks($query = null)
    {
        $q = $this->createQueryBuilder('book')
            ->leftJoin('book.author', 'author');
        if(!empty($query)) {
            $q->andWhere('author.lastName = :query OR author.firstName LIKE :query OR book.title LIKE :query')
                ->setParameter('query', '%'.$query.'%');
        }

        return $q
            ->getQuery()
            ->getResult();
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