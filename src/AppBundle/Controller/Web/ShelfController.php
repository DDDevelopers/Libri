<?php

namespace AppBundle\Controller\Web;

use AppBundle\Entity\Book;
use AppBundle\Entity\UserBookShelf;
use AppBundle\Form\BookToShelfType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ShelfController extends Controller
{
    /**
     * @Route("/shelf/book/{id}", name="save_book_in_shelf")
     */
    public function createAction(Request $request, Book $book)
    {
        $em = $this->getDoctrine()->getManager();
        $bookToShelf = $em->getRepository(UserBookShelf::class)->findOneBy([
            'book' => $book->getId(),
            'user' => $this->getUser()->getId()
        ]);
        //if there is no row then create new one
        if(!$bookToShelf) {
            $bookToShelf = new UserBookShelf();
        }

        $form = $this->createForm(BookToShelfType::class, $bookToShelf);
        $form->handleRequest($request);

        if($form->isValid()) {
            $bookToShelf->setUser($this->getUser());
            $bookToShelf->setBook($book);
            $em->persist($bookToShelf);
            $em->flush();
            $this->addFlash('success', 'Added to your shelf.');
        }else{
            $this->addFlash('error', 'Something not right !');
        }

        return $this->redirectToRoute('view_the_book', ['id' => $book->getId()]);
    }
}
