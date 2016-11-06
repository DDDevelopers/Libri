<?php
namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Shelf;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadShelfData implements FixtureInterface 
{
    public function load(ObjectManager $em)
    {
        $shelf = [
            'Read',
            'Want to read',
            'Currently reading',
        ];

        foreach ($shelf as $item) {
            $sh = new Shelf();
            $sh->setName($item);
            $em->persist($sh);
            $em->flush();
        }
    }
}