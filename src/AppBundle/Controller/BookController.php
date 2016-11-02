<?php
namespace AppBundle\Controller;


use AppBundle\Entity\Book;
use AppBundle\Entity\Review;
use AppBundle\Form\BookType;
use AppBundle\Form\ReviewType;
use AppBundle\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
            $em = $this->getDoctrine()->getManager();
            if($book = $em->getRepository('AppBundle:Book')->findBookByTitle($form->getData()->getTitle())) {
                $book->setPeacesInShelf($book->getPeacesInShelf() + 1);
            }else{
                /** @var Book $book */
                $book = $form->getData();
                $book->setPeacesInShelf(1);
                $book->setUser($this->getUser());
            }
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
     * @param Book $book
     * @Route("/book/{id}", name="view_the_book")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(Book $book)
    {
        $reviewForm = $this->createForm(ReviewType::class, new Review(), [
            'method' => 'post',
            'action' => $this->generateUrl('insert_new_review', ['id' => $book->getId()])
        ]);
        //this will show the book
        return $this->render('AppBundle:book:book.html.twig', [
            'book' => $book,
            'reviewForm' => $reviewForm->createView()
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