<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            // already logged in as classic user
            return $this->redirectToRoute('AssociationBundle_homepage');
        } else if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
            // already logged in as admin
            return $this->redirectToRoute('AdminBundle_homepage');
        } else {
            return $this->redirectToRoute('UserBundle_login');
        }
    }

}