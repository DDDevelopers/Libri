<?php
namespace AppBundle\Controller\Api;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AuthorController extends Controller
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

}