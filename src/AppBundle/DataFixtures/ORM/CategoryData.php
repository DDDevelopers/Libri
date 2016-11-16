<?php
namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Category;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryData implements FixtureInterface 
{
    public function load(ObjectManager $manager)
    {
        $categories = [
            'Arts & Photography',
            'Biography & Memoirs',
            'Children\'s Books',
            'Cookbooks, Food & Wine',
            'History',
            'Literature & Fiction',
            'Mystery & Suspense',
            'Sci-Fi & Fantasy',
            'Teens & Young Adult'
        ];

        foreach ($categories as $category) {
            $cat = new Category();

            $cat->setTitle($category);
            $manager->persist($cat);
            $manager->flush();
        }
    }
}