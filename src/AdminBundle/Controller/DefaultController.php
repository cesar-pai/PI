<?php

namespace AdminBundle\Controller;

use DemandeSubventionBundle\Entity\Demandessubvention;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\VarDumper\VarDumper;

class DefaultController extends Controller
{
    public function indexAction()
    {
        if ($this->get('security.context')->isGranted('ROLE_ADMIN'))
        {
//      Get Association
            $associations = $this->getDoctrine()
                ->getRepository('AssociationBundle:Associations')
                ->findAll();

            $demandessubvention = array(); //Array of Demande de Subvention

            foreach($associations as $assoc) {
//            Get Demande Subvention
                $demandessubvention = $this->getDoctrine()
                    ->getRepository('DemandeSubventionBundle:Demandessubvention')
                    ->findBy(array('associationsNumassoc' => $assoc));
            };

            // redirect authenticated users to homepage
            return $this->render('AdminBundle:Default:index.html.twig',array('associations' => $associations, 'demandessubvention' => $demandessubvention));
        }
        else if ($this->get('security.context')->isGranted('ROLE_USER')) {

            // redirect authenticated admin to homepage
            return $this->redirectToRoute('AssociationBundle_homepage');
        } else {
            return $this->redirectToRoute('UserBundle_login');
        }
    }
}
