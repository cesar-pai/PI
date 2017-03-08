<?php

namespace DemandeSubventionBundle\Controller;

use AssociationBundle\Entity\Associations;
use DemandeSubventionBundle\Entity\Demandessubvention;
use DocumentBundle\Entity\Documents;

use DemandeSubventionBundle\Form\DemandeFormType;

use AppBundle\Model\HZip;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Process\Exception\ProcessTimedOutException;

use Symfony\Component\VarDumper\VarDumper;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;

class DemandeController extends Controller
{
    public function dossierAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER'))
        {
            // Get User
            $user = $this->getUser();

            // Get Association
            $association = $this->getDoctrine()
                ->getRepository('AssociationBundle:Associations')
                ->findOneBy(array('users' => $user));

            if ($association instanceof Associations)
            {
                // Get Test Demande Subvention
                $testds = $this
                    ->getDoctrine()
                    ->getRepository('DemandeSubventionBundle:Demandessubvention')
                    ->findOneBy(array('associationsNumassoc' => $association),array('id' => 'DESC'));

                $isAvailable = $testds instanceof Demandessubvention
                                ? ($testds->getUpdatedAt()->format('m') <= 2
                                    ? $testds->getUpdatedAt()->format('Y')
                                    : $testds->getUpdatedAt()->format('Y') + 1)
                                : null ;

                if($isAvailable != $this->getSubvYear())
                {
                    $form = $this->get('form.factory')->createBuilder(new DemandeFormType())
                        ->getForm();

                    $form['documents']->setData($this->setDocumentsDemande());

                    // 2) handle the submit (will only happen on POST)
                    if ($form->handleRequest($request)->isValid()) {

                        // Set Demande subvention
                        $demandesubvention = $form['demandesubvention']->getData();
                        $demandesubvention->setAssociationsNumassoc($association);
                        $demandesubvention->setActivitespayantes(implode(", ", $demandesubvention->getActivitespayantes())); //Rassemble tous les choix en une string

                        // Set Pers en charge
                        $persencharge = $form['persencharge']->getData();
                        $persencharge->setDemandessubvention($demandesubvention);

                        // Set Travaux investissement
                        $travauxinvestissement = $form['travauxinvestissement']->getData();

                        // Set Bilan activite
                        $bilanactivite = $form['bilanactivite']->getData();
                        $bilanactivite->setDemandessubvention($demandesubvention);

                        // Set Actions
                        $actions = $form['actions']->getData();

                        // Set Subventions
                        $subventions = $form['subventions']->getData();

                        // Set Manifestations
                        $manifestations = $form['manifestations']->getData();

                        // Set Faits marquants
                        $faitsmarquants = $form['faitsmarquants']->getData();

                        // Set Mise a dispo
                        $miseadispo = $form['miseadispo']->getData();

                        // Set Documents
                        $documents = $form['documents']->getData();

                        // Set Entity Manager
                        $em = $this->getDoctrine()->getManager();

                        $dossier = $this->createDossierDemande($association,$demandesubvention,$bilanactivite,$persencharge,$manifestations,$actions,$faitsmarquants,$subventions,$miseadispo,$travauxinvestissement);

                        $uploaded[] = $dossier; //Documents qui ont été uploadés pour la demande de subvention

                        if($demandesubvention->getActivitespayantes() != null) {
                            $activitespayantes = $demandesubvention->getActivitespayantes();
                            $demandesubvention->setActivitespayantes(implode(", ", $activitespayantes));
                        }

                        $em->persist($demandesubvention);

                        $em->persist($bilanactivite);

                        $em->persist($persencharge);

                        foreach($documents as $docs => $doc){
                                if(is_uploaded_file($doc->getFile())) {
                                    if(($doc->getObjet() == "planfinancement") || $doc->getObjet() == "devis") {
                                        $doc->setTravauxinvestissements($travauxinvestissement);
                                    } else if($doc->getObjet() == "bilanactivite") {
                                        $doc->setBilansactivite($bilanactivite);
                                    } else {
                                        $doc->setDemandesubvention($demandesubvention);
                                    }
                                    $uploaded[] = $doc;
                                }
                        }

                        if($travauxinvestissement != null){
                            $travauxinvestissement->setDemandessubvention($demandesubvention);
                            $em->persist($travauxinvestissement);
                        }

                        foreach($actions as $action => $ac) {
                            $ac->setDemandessubvention($demandesubvention);
                            $em->persist($ac);
                        }

                        foreach($subventions as $subvention => $sub) {
                            $sub->setDemandessubvention($demandesubvention);
                            $em->persist($sub);
                        }

                        foreach($miseadispo as $misedispo => $dispo) {
                            $dispo->setDemandessubvention($demandesubvention);
                            $em->persist($dispo);
                        }

                        foreach($manifestations as $manifestation => $manif) {
                            $manif->setBilansactivite($bilanactivite);
                            $em->persist($manif);
                        }

                        foreach($faitsmarquants as $faitmarquant => $fait) {
                            $fait->setBilansactivite($bilanactivite);
                            $em->persist($fait);
                        }

                        // On persiste tout les documents uploadés
                        foreach($uploaded as $uploads => $up) {
                            $em->persist($up);
                        }

                        $em->flush();

                        // On créé le zip associé
                        $sourcepath = $this->get('kernel')->getRootDir() . '/../web/uploads/'.$association->getNumassoc().'/demandessubvention/demandesubvention-'.$this->getsubvYear().'/';
                        $targetpath = $sourcepath.'/demandesubvention-'.$this->getsubvYear().'.zip';
                        HZip::zipDir($sourcepath,$targetpath);

                        // Remove all tmp files
                        $tmpfiles = glob($this->get('kernel')->getRootDir().'/../web/uploads/tmp/*'); // get all file names
                        foreach($tmpfiles as $tmpfile){ // iterate files
                            if(is_file($tmpfile))
                                unlink($tmpfile); // delete file
                        }

                        return $this->redirectToRoute('AssociationBundle_homepage');
                    }
                    else return $this->render('DemandeSubventionBundle:Demande:demandesubvention.html.twig', array('form' => $form->createView(),'accueil' => false));
                }
                else return $this->redirectToRoute('AssociationBundle_homepage');
            }
            else return $this->redirectToRoute('AssociationBundle_association');
        }
        else return $this->redirectToRoute('UserBundle_login');
    }

    public function setDocumentsDemande(){

        // Les différents fichiers qui seront uploadés lors de l'enregistrement de l'association
        $bilans = new Documents();
        $bilans->setObjet('bilans');

        $comptesresultat = new Documents();
        $comptesresultat->setObjet('comptesresultat');

        $rapportactivite = new Documents();
        $rapportactivite->setObjet('rapportactivite');

        $planfinancement = new Documents();
        $planfinancement->setObjet('planfinancement');

        $devis = new Documents();
        $devis->setObjet('devis');

        $bilanactivite = new Documents();
        $bilanactivite->setObjet('bilanactivite');

        $tarifs = new Documents();
        $tarifs->setObjet('tarifs');

        $bilanfin = new Documents();
        $bilanfin->setObjet('bilanfinancier');

        $budgetprev = new Documents();
        $budgetprev->setObjet('budgetprevisionnel');

        return $documents = [$bilans,$comptesresultat,$rapportactivite,$planfinancement,$devis,$bilanactivite,$tarifs,$bilanfin,$budgetprev];
    }

    public function createDossierDemande($association,$demandesubvention,$bilanactivite,$persencharge,$manifestations,$actions,$faitsmarquants,$subventions,$miseadispo,$travauxinvestissement) {
        // Création du PDF dossier de demande de subvention de l'association

        $recap = new Documents();
        $recap->setObjet('dossier-demandesubvention-'.$this->getsubvYear());
        $recap->setNom('demandesubvention'.$this->getsubvYear());
        $recap->setDemandesubvention($demandesubvention);
        $path = $association->getNumassoc().'/demandessubvention/demandesubvention-'.$this->getsubvYear().'/'.$recap->getObjet().'/'.$recap->getNom().'.pdf';
        $recap->setPath($path);

        // On genère la vue à convertir en PDF, en n'oubliant pas les paramètres twig si la vue comporte des données dynamiques
        $file = $this->get('knp_snappy.pdf');

        // On save la session
        $session = $this->getRequest()->getSession();
        $session->save();
        $file->generateFromHtml(
            $this->renderView(
                'DemandeSubventionBundle:PDF:demandesubvention-pdf.html.twig',
                array(
                    'association'                   => $association,
                    'demandesubvention'             => $demandesubvention,
                    'bilanactivite'                 => $bilanactivite,
                    'persencharge'                  => $persencharge,
                    'manifestations'                => $manifestations,
                    'actions'                       => $actions,
                    'faitsmarquants'                => $faitsmarquants,
                    'subventions'                   => $subventions,
                    'miseadispo'                    => $miseadispo,
                    'travauxinvestissement'         => $travauxinvestissement,
                    'cookie' => array($session->getName() => $session->getId()),
                    'disable-javascript' => true
                )
            ),
            $this->get('kernel')->getRootDir() . '/../web/uploads/'.$path
        );

        return $recap;
    }

    /**
     * Get the year associated to the current date
     * (if the current month is <= february, the subsidy is for the current year, otherwise it is for the next year)
     */
    private function getSubvYear()
    {
        return date('m') <= 2 ? date('Y') : date('Y') + 1;
    }
}