<?php

namespace FacebookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    public function indexAction()
    {
       
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('FacebookBundle:User')->findAll();

        $data = $this->get('jms_serializer')->serialize($users, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
