<?php

namespace DemandeSubventionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DemandeSubventionBundle:Default:index.html.twig', array('name' => $name));
    }
}
