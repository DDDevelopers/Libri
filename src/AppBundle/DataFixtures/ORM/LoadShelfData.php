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
            'Read' => 3,
            'Want to read' => 2,
            'Currently reading' => 1,
        ];

        foreach ($shelf as $item => $order) {
            $sh = new Shelf();
            $sh->setOrder($order);
            $sh->setName($item);
            $em->persist($sh);
            $em->flush();
        }
    }
}