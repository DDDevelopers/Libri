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

        }

        return $this->render('@App/book/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}