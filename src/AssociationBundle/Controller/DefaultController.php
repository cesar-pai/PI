<?php

namespace AssociationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    public function indexAction()
    {

//      Get User
        $user = $this->get('security.token_storage')->getToken()->getUser();

//      Get Association
        $association = $this->getDoctrine()
            ->getRepository('AssociationBundle:Associations')
            ->findOneBy(array('users' => $user));

//      Get Demande Subvention du dernière enregistrement
        $demandesubvention = $this->getDoctrine()
            ->getRepository('DemandeSubventionBundle:Demandessubvention')
            ->findOneBy(array('associationsNumassoc' => $association),array('id' => 'DESC'));

        if ($this->get('security.context')->isGranted('ROLE_ADMIN'))
        {
            // redirect authenticated admin to homepage
            return $this->redirectToRoute('AdminBundle_homepage');
        }
        else if ($this->get('security.context')->isGranted('ROLE_USER')) {
            // redirect authenticated users to homepage
            return $this->render('AssociationBundle:Default:index.html.twig', array('association' => $association, 'demandesubvention' => $demandesubvention,'accueil' => true));
        } else {
            //return $this->redirect('http://www.villerslesnancy.fr/fr/subvention-communale.html');
            return $this->redirectToRoute('UserBundle_login');
        }
    }
}
