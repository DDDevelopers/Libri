<?php
namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class TimelineRepository extends EntityRepository
{
    public function getAllAndOrderByLatest()
    {
        return $this->createQueryBuilder('t')
            ->orderBy('t.createdAt', 'DESC')
            ->setMaxResults(20)
            ->getQuery()
            ->getResult();
    }
}