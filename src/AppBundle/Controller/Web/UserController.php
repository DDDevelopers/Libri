<?php
namespace AppBundle\Controller\Web;


use AppBundle\Entity\Book;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="user_index")
     */
    public function indexAction(Request $request)
    {
        return $this->render('diar');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/register", name="register_user")
     */
    public function registerAction(Request $request)
    {
        $user = new User();
        $form = $this->createUserForm($user);
        $form->handleRequest($request);

        if($form->isValid() && $form->isSubmitted()){

            //set the password to hash
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $this->addFlash('success', 'The user has been registred...');
            $user->setCreatedAt(new \DateTime('now'));
            $em->persist($user);
            $em->flush();
        }
        return $this->render('@App/register.html.twig', ['form' => $form->createView()]);
    }
    
    /**
     * Form builder
     */
    public function createUserForm($class, $url = 'register_user', $options = array())
    {
        return $this->createForm(UserType::class, $class, [
            'action' => $this->generateUrl($url, $options),
            'method' => 'POST'
        ])->add('save', SubmitType::class);
    }

    /**
     * @Route("/books/added", name="my_added_books")
     */
    public function myAddedBooksAction()
    {
        $em = $this->getDoctrine()->getManager();
        $books = $em->getRepository(Book::class)->findUsersBooks($this->getUser());

        return $this->render('AppBundle:user:my_books.html.twig', [
            'books' => $books
        ]);
    }
}