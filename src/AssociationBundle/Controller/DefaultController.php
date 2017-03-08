<?php

namespace AssociationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    public function indexAction()
    {

        // Get User
        $user = $this->get('security.token_storage')->getToken()->getUser();

        // Get Association
        $association = $this->getDoctrine()
            ->getRepository('AssociationBundle:Associations')
            ->findOneBy(array('users' => $user));

        // Get Demande Subvention du dernière enregistrement
        $demandesubvention = $this->getDoctrine()
            ->getRepository('DemandeSubventionBundle:Demandessubvention')
            ->findOneBy(array('associationsNumassoc' => $association),array('id' => 'DESC'));

        // set the demandesubvention to null so that the user can create a new subsidy
        if ($demandesubvention != null && ($demandesubvention->getUpdatedAt()->format('m') <= 2 ? $demandesubvention->getUpdatedAt()->format('Y') : $demandesubvention->getUpdatedAt()->format('Y') + 1) < (date('m') <= 2 ? date('Y') : date('Y') + 1))
            $demandesubvention = null;

        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
            return $this->redirectToRoute('AdminBundle_homepage');      // redirect authenticated admin to homepage
        else if ($this->get('security.authorization_checker')->isGranted('ROLE_USER'))
            return $this->render('AssociationBundle:Default:index.html.twig', array('association' => $association, 'demandesubvention' => $demandesubvention,'accueil' => true));       // redirect authenticated users to homepage
        else        //return $this->redirect('http://www.villerslesnancy.fr/fr/subvention-communale.html');
            return $this->redirectToRoute('UserBundle_login');
    }
}
