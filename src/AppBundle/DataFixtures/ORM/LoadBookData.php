<?php
/**
 * Created by PhpStorm.
 * User: diar
 * Date: 9/18/16
 * Time: 10:41 PM
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Author;
use AppBundle\Entity\Book;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadBookData implements FixtureInterface
{
    public function load(ObjectManager $em)
    {
        $books = [
            'The Great Gatsby' => 'F. Scott Fitzgerald',
            'The Grapes Of Wrath' => 'John Steinbeck',
            'Nineteen Eighty Four' => 'George Orwell',
            'Ulysses' => 'James Joyce',
            'Lolita' => 'Vladimir Nabokov',
            'Catch 22' => 'Joseph Heller',
            'The Catcher In The Rye' => 'J. D. Salinger',
            'Beloved' => 'Toni Morrison'
        ];
        foreach ($books as $book => $author) {

            $auth = new Author();
            $auth->setFirstName($author);
            $auth->setLastName($author);
            $auth->setCreatedAt(new \DateTime());
            $em->persist($auth);
            $em->flush();

            $b = new Book();
            $b->setTitle($book);
            $b->setDescription('Dummy data');
            $b->setPages(111);
            $b->setCreatedAt(new \DateTime());
            $b->setUpdatedAt(new \DateTime());
            $b->setAuthor($auth);
            $em->persist($b);
            $em->flush();
        }
    }
}