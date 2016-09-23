<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $books = $em->getRepository('AppBundle:Book')->findAll();

        if(!$books){
            throw new NotFoundHttpException('There is no books in there, try to load the fixtures !');
        }

        // replace this example code with whatever you need
        return $this->render('AppBundle::dashboard.html.twig', [
            'books' => $books
        ]);
    }
}
