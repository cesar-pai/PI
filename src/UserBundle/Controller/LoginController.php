<?php

namespace UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Controller\SecurityController as BaseController;

class LoginController extends BaseController
{
    public function loginAction()
    {
        if ($this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
        {
            // redirect authenticated admin to homepage
            return $this->redirectToRoute('AdminBundle_homepage');
        }
        else if ($this->container->get('security.authorization_checker')->isGranted('ROLE_USER'))
        {
            // redirect authenticated users to homepage
            return $this->redirectToRoute('AssociationBundle_homepage');
        }
        else
        {
            $response = parent::loginAction();
            return $response;
        }
    }
}