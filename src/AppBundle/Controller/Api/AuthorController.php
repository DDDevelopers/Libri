<?php
namespace AppBundle\Controller\Api;
header("Content-Type: application/json;charset=utf-8");

use AppBundle\Controller\BaseController;
use AppBundle\Entity\Author;
use JMS\Serializer\Serializer;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthorController extends BaseController
{

    /**
     * This is the documentation description of your method, it will appear
     * on a specific pane. It will read all the text until the first
     * annotation.
     * @Route("/author")
     * @Method(methods={"get"})
     * @ApiDoc(
     *  resource=true,
     * )
     */
    public function getAction()
    {
        $em = $this->getDoctrine()->getManager();

        $authors = $em->getRepository(Author::class)->findAll();

        if(!$authors) {
            return new JsonResponse(['error' => 'No authors found !'], 500);
        }

        return $this->createApiResponse($authors);
    }

    /**
     * This is the documentation description of your method, it will appear
     * on a specific pane. It will read all the text until the first
     * annotation.
     * @Route("/author")
     * @Method(methods={"post"})
     * @ApiDoc(
     *  resource=true,
     * )
     */
    public function postAction()
    {

    }

    /**
     * This is the documentation description of your method, it will appear
     * on a specific pane. It will read all the text until the first
     * annotation.
     * @Route("/author/{id}")
     * @Method(methods={"get"})
     * @ApiDoc(
     *  resource=true,
     * )
     */
    public function oneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $author = $em->getRepository(Author::class)->find($id);

        if(!$author) {
            return new JsonResponse(['error' => 'No author found !'], 500);
        }

        return $this->createApiResponse($author);
    }

}