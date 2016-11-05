<?php
namespace AppBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $em)
    {
        Fixtures::load(
            __DIR__ . '/fixtures.yml',
            $em, [
            'providers' => [$this]
        ]);
    }

    public function title()
    {
        $books = [
            "Book",
            "The Great Gatsby	",
            "The Grapes Of Wrath	",
            "Nineteen Eighty Four	",
            "Ulysses	",
            "Lolita	",
            "Catch 22	",
            "The Catcher In The Rye	",
            "Beloved",
            "A Game of Thrones ",
            "A Clash of Kings ",
            "A Storm of Swords ",
            "A Feast for Crows",
            "A Dance with Dragons ",
            "The Winds of Winter ",
            "A Dream of Spring ",
            "Book	Author	",
            "To Kill A Mockingbird",
            "Harry Potter And The Sorcerer's Stone",
            "1984	George Orwell",
            "Pride And Prejudice",
            "The Diary Of A Young Girl",
            "Animal Farm",
            "The Hobbit",
            "The Little Prince",
        ];
        $key = array_rand($books);
        return $books[$key];
    }
}