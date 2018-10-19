<?php

namespace FacebookBundle\Controller;

use FacebookBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * User controller.
 *
 */
class UserController extends Controller
{
    
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('FacebookBundle:User')->findAll();

        return $this->render('user/index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * @Get(
     *     path = "/user/{id}/show",
     *     name = "user_show",
     *     requirements = {"id"="\d+"}
     * )
    * @View
     */
    public function showAction(User $user)
    {

        return $user;
    }

    public function ajouteramisAction($id){

        $user=$this->getUser();
        $amis = new User();
        $em = $this->getDoctrine()->getManager();
        $amis= $em->getRepository('FacebookBundle:User')->find($id);
        $user->addAmi($amis);
        $em->persist($user);
        $em->flush();
        return new Response('', Response::HTTP_CREATED);
    }
    public function supprimeramisAction($id){

        $user=$this->getUser();
        $amis = new User();
        $em = $this->getDoctrine()->getManager();
        $amis= $em->getRepository('FacebookBundle:User')->find($id);
        $user->removeAmi($amis);
        $em->persist($user);
        $em->flush();
         return new Response('', Response::HTTP_CREATED);
    }
     /**
     * @Rest\Post(
     *    path = "/ajouteramis",
     *    name = "ajouter_amis"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("user", converter="fos_rest.request_body")
     */
     public function ajouteruseramisAction(Request $request ,User $user){

        
        $user->setEnabled(true);
        
        $event = new GetResponseUserEvent($user, $request);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $this->createForm('FacebookBundle\Form\AddUSerType', $user);
        $form->setData($user);

        $form->handleRequest($request);

        if (true) {
            
        $em = $this->getDoctrine()->getManager();
       
        $em->persist($user);
        $em->flush();


                 return new Response('', Response::HTTP_CREATED);
            }

            $event = new FormEvent($form, $request);
            $this->eventDispatcher->dispatch(FOSUserEvents::REGISTRATION_FAILURE, $event);

            if (null !== $response = $event->getResponse()) {
               return  $response;
            }
        

     }

}
