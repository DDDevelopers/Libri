<?php
namespace AppBundle\Controller;


use AppBundle\Entity\Book;
use AppBundle\Form\BookType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends Controller
{
    /**
     * @Route("/book/new", name="add_new_book")
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(BookType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $book = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();

            $this->addFlash('success', 'Thanks, the book is added in the shelf.');
            $this->redirectToRoute('homepage');
        }

        return $this->render('@App/book/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/book/{id}/edit", name="edit_the_book")
     */
    public function editAction(Request $request, Book $book)
    {
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $book = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();

            $this->addFlash('success', 'Thanks, the book is updated now.');
            $this->redirectToRoute('homepage');
        }

        return $this->render('@App/book/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}