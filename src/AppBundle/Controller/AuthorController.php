<?php
namespace AppBundle\Controller;


use AppBundle\Form\AuthorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends Controller
{
    /**
     * @Route("/author/new", name="new_author")
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(AuthorType::class);

        //only for POST request !
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $author = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($author);
            $em->flush();

            $this->addFlash('success', 'Great your author is added :)');

            return $this->redirectToRoute('new_author');
        }

        return $this->render('@App/author/register.html.twig', array(
            'form' => $form->createView()
        ));
    }
}