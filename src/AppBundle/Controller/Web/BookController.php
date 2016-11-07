<?php
namespace AppBundle\Controller\Web;


use AppBundle\Entity\Book;
use AppBundle\Entity\Review;
use AppBundle\Entity\UserBookShelf;
use AppBundle\Form\BookToShelfType;
use AppBundle\Form\BookType;
use AppBundle\Form\RateType;
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

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $book = $form->getData();
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
        $em = $this->getDoctrine()->getManager();

        $addToShelfForm = $this->createForm(BookToShelfType::class, $em->getRepository(UserBookShelf::class)->findOneBy([
            'user' => $this->getUser()->getId(),
            'book' => $book->getId()
        ]), [
            'action' => $this->generateUrl('save_book_in_shelf', ['id' => $book->getId()]),
            'method' => 'post'
        ]);

        $rate = $em->getRepository(Review::class)->findOneBy([
            'book' => $book->getId(),
            'user' => $this->getUser()->getId()
        ]);

        if(!$rate) {
            $rate = new Review();
        }


        $rateForm = $this->createForm(RateType::class, $rate, [
            'method' => 'post',
            'action' => $this->generateUrl('rate_the_book', ['id' => $book->getId()])
        ])
            ->add('submit', SubmitType::class);

        $reviewForm = $this->createForm(ReviewType::class, $rate, [
            'method' => 'post',
            'action' => $this->generateUrl('insert_new_review', ['id' => $book->getId()])
        ]);
        //this will show the book
        return $this->render('@App/book/book.html.twig', [
            'book' => $book,
            'reviewForm' => $reviewForm->createView(),
            'shelfForm' => $addToShelfForm->createView(),
            'rateForm' => $rateForm->createView()
        ]);
    }

    /**
     * @Route("/book/{id}/edit", name="edit_the_book")
     */
    public function editAction(Request $request, Book $book)
    {
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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