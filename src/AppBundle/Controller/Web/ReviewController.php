<?php

namespace AppBundle\Controller\Web;

use AppBundle\Entity\Book;
use AppBundle\Entity\Review;
use AppBundle\Form\RateType;
use AppBundle\Form\ReviewType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class ReviewController extends Controller
{

    /**
     * @param Request $request
     * @Route("/review/update/{id}", name="insert_new_review")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function insertAction(Request $request, Book $book)
    {
        $em = $this->getDoctrine()->getManager();

        $review = $em->getRepository(Review::class)->findOneBy([
            'book' => $book->getId(),
            'user' => $this->getUser()->getId()
        ]);

        if(!$review) {
            $review = new Review();
        }

        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $review->setBook($book);
            $review->setUser($this->getUser());
            $em->persist($review);
            $em->flush();
            $this->addFlash('success', 'Hej, thanks for the review.');
        } else {
            $this->addFlash('error', 'Hmmm, something wasn\'t right !');
        }

        return $this->redirectToRoute('view_the_book', ['id' => $book->getId()]);
    }

    /**
     * @param Request $request
     * @param Book $book
     * @Route("/review/book/{id}", name="rate_the_book")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function reviewAction(Request $request, Book $book)
    {
        $em = $this->getDoctrine()->getManager();
        $rate = $em->getRepository(Review::class)->findOneBy([
            'book' => $book->getId(),
            'user' => $this->getUser()->getId()
        ]);

        if (!$rate) {
            $rate = new Review();
        }

        $form = $this->createForm(RateType::class, $rate);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $rate->setUser($this->getUser());
            $rate->setBook($book);
            $em->persist($rate);
            $em->flush();
            $this->addFlash('success', 'Hej, thanks for the review.');
        } else {
            $this->addFlash('error', 'Hmmm, something wasn\'t right !');
        }
        return $this->redirectToRoute('view_the_book', ['id' => $book->getId()]);
    }

    /**
     * @param Book $book
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/review/book/{id}/remove", name="remove_the_review_from_the_book")
     */
    public function removeRateAction(Book $book)
    {
        $em = $this->getDoctrine()->getManager();
        $rate = $em->getRepository(Review::class)->findOneBy([
            'book' => $book->getId(),
            'user' => $this->getUser()->getId()
        ]);

        $rate->setRating(null);
        $em->persist($rate);
        $em->flush();
        $this->addFlash('success', 'Removed successfully !');

        return $this->redirectToRoute('view_the_book', ['id' => $book->getId()]);
    }
}
