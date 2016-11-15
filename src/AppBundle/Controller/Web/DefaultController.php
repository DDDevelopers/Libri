<?php

namespace AppBundle\Controller\Web;

use AppBundle\Entity\Book;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $books = $em->getRepository(Book::class)->searchAllBooks($request->query->get('search'));
        
        // replace this example code with whatever you need
        return $this->render('@App/dashboard.html.twig', [
            'books' => $books
        ]);
    }
}
