<?php
/**
 * Created by PhpStorm.
 * User: diar
 * Date: 16-11-17
 * Time: 9.35.MD
 */
namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ShelfRepository extends EntityRepository
{
    public function findByUser($userId)
    {
        return $this->createQueryBuilder('sh')
            ->addSelect('ub')
            ->addSelect('user')
            ->addSelect('b')
            ->addSelect('reviews')
            ->leftJoin('sh.usersBooks', 'ub')
            ->leftJoin('ub.user','user')
            ->leftJoin('ub.book', 'b')
            ->leftJoin('b.reviews', 'reviews')
            ->andWhere('user.id = :userid')
            ->setParameter('userid', $userId)
            ->getQuery()
            ->getResult();
    }
}