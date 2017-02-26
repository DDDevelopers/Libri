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
            'Arts & Photography' => 'paintpalete123.png',
            'Biography & Memoirs' => 'weddingphoto123.png',
            'Children\'s Books' => 'children123.png',
            'Cookbooks, Food & Wine' => 'winefood123.png',
            'History' => 'history.png',
            'Literature & Fiction' => 'literature.png',
            'Mystery & Suspense' => 'mystery.png',
            'Sci-Fi & Fantasy' => 'scifi.png',
            'Teens & Young Adult' => 'teen.png'
        ];

        foreach ($categories as $category => $image) {
            $cat = new Category();

            $cat->setIcon($image);
            $cat->setTitle($category);
            $manager->persist($cat);
            $manager->flush();
        }
    }
}