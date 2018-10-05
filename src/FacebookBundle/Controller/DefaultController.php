<?php

namespace FacebookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('FacebookBundle:User')->findAll();

        return $this->render('FacebookBundle:Default:index.html.twig', array(
            'users' => $users,
        ));
    }
}
