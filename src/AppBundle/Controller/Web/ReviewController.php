<?php

namespace AppBundle\Controller\Web;

use AppBundle\Entity\Book;
use AppBundle\Form\ReviewType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ReviewController extends Controller
{

    /**
     * @param Request $request
     * @Route("/insert/{id}", name="insert_new_review")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function insertAction(Request $request, Book $book)
    {
        $form = $this->createForm(ReviewType::class);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $review = $form->getData();
            $review->setBook($book);
            $em->persist($book);
            $em->flush();

            $this->addFlash('success', 'Hej, thanks for the review.');
        }else{
            $this->addFlash('error', 'Hmmm, something wasn\'t right !');
        }
        return $this->redirectToRoute('view_the_book', ['id' => $book->getId()]);
    }
}
