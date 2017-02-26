<?php

namespace AppBundle\Controller\Web;


use AppBundle\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller
{
    /**
     * @Route("/category/{id}", name="category_books")
     */
    public function indexAction(Category $category)
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Category::class)->findAll();

        return $this->render('@App/category/book_list.html.twig', [
            'currentCategory' => $category,
            'categories' => $categories
        ]);
    }
}