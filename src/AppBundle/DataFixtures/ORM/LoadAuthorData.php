<?php
/**
 * Created by PhpStorm.
 * User: diar
 * Date: 9/18/16
 * Time: 10:04 PM
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Author;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadAuthorData implements FixtureInterface
{
    public function load(ObjectManager $em)
    {
        $authors = [
            'Diar Selimi',
            'Dardan Demiri',
            'Test Test',
            'Naim Frasheri'
        ];

        foreach ($authors as $author) {
            $auth = new Author();
            $auth->setFirstName(explode(' ', $author)[0]);
            $auth->setLastName(explode(' ', $author)[1]);
            $auth->setCreatedAt(new \DateTime());
            $em->persist($auth);
            $em->flush();
        }
    }
}