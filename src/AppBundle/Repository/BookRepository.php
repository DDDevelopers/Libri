<?php
namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class BookRepository extends EntityRepository
{

    public function searchAllBooks($query = null)
    {
        $q = $this->createQueryBuilder('book');

        return $q->getQuery()->getResult();
    }
}