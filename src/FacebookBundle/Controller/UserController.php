<?php

namespace FacebookBundle\Controller;

use FacebookBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * User controller.
 *
 */
class UserController extends Controller
{
    /**
     * Lists all user entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('FacebookBundle:User')->findAll();

        return $this->render('user/index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Finds and displays a user entity.
     *
     */
    public function showAction(User $user)
    {

        return $this->render('user/show.html.twig', array(
            'user' => $user,
        ));
    }

    public function ajouteramisAction($id){

        $user=$this->getUser();
        $amis = new User();
        $em = $this->getDoctrine()->getManager();
        $amis= $em->getRepository('FacebookBundle:User')->find($id);
        $user->addAmi($amis);
        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute('fos_user_profile_show');
    }
    public function supprimeramisAction($id){

        $user=$this->getUser();
        $amis = new User();
        $em = $this->getDoctrine()->getManager();
        $amis= $em->getRepository('FacebookBundle:User')->find($id);
        $user->removeAmi($amis);
        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute('fos_user_profile_show');
    }

}
