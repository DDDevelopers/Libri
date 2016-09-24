<?php
namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class AuthorRepository extends EntityRepository
{
    public function createAlphabeticalQueryBuilder()
    {
        return $this->createQueryBuilder('author')
            ->orderBy('author.firstName', 'ASC');
    }

}