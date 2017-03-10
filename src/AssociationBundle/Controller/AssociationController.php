<?php

namespace AssociationBundle\Controller;

use AssociationBundle\Entity\Affiliations;
use AssociationBundle\Entity\Agrementsadministratifs;
use AssociationBundle\Entity\Expertscomptable;
use AssociationBundle\Entity\Responsables;
use DocumentBundle\Entity\Documents;
use AppBundle\Model\HZip;
use Symfony\Component\Filesystem\Filesystem;
use AssociationBundle\Form\RegistrationFormType;
use AssociationBundle\Form\UpdateFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Forms;

class AssociationController extends Controller
{
    public function AssociationAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
        {
            // redirect authenticated admin to homepage
            return $this->redirectToRoute('AdminBundle_homepage');
        }
        else if ($this->get('security.authorization_checker')->isGranted('ROLE_USER'))
        {
            // Get User
            $user = $this->getUser();

            // Get Association
            $association = $this->getDoctrine()
                ->getRepository('AssociationBundle:Associations')
                ->findOneBy(array('users' => $user));

            if($association == null)
            {
                // 1) build the form
                $form = $this->createForm(new RegistrationFormType());

                $form['documents']->setData($this->setDocumentsAssociation());

                // 2) handle the submit (will only happen on POST)
                if ($form->handleRequest($request)->isValid()) {

                    // Set Association
                    $association = $form['association']->getData();

                    $association->setUsers($user);

                    // Set Responsable
                    $responsable = $form['responsable']->getData();
                    $responsable->setAssociationsNumassoc($association);

                    // Set Agrement administratif
                    $agrementadministratif = $form['agrementadministratif']->getData();

                    // Set Affiliation
                    $affiliation = $form['affiliation']->getData();

                    // Set Expert comptable
                    $expertcomptable = $form['expertcomptable']->getData();

                    // Set Membres Conseil Administration
                    $membresconseil = $form['membreconseiladministration']->getData();

                    // Set Bureau
                    $bureau = $form['bureau']->getData();
                    $bureau->setAssociationsNumassoc($association);

                    // Set Membres Bureau
                    $membresbureau = $form['membrebureau']->getData();

                    // Set Categories Adhérents
                    $categoriesadherents = $form['categorieadherent']->getData();

                    // Set Documents
                    $documents = $form['documents']->getData();

                    $recap = $this->createRecapAssociation($association,$bureau,$affiliation,$expertcomptable,$categoriesadherents,$membresbureau,$membresconseil,$agrementadministratif,$responsable);

                    // Documents qui ont été uploadés
                    $uploaded[] = $recap;

                    // Set Entity Manager
                    $em = $this->getDoctrine()->getManager();

                    foreach($categoriesadherents as $categorieadherents => $ca) {
                        $ca->setAssociationsNumassoc($association);
                        $em->persist($ca);
                    }

                    foreach($membresconseil as $membreconseil => $mc) {
                        $mc->setAssociationsNumassoc($association);
                        $em->persist($mc);
                    }

                    foreach($membresbureau as $membrebureau => $mb) {
                        $mb->setBureaux($bureau);
                        $em->persist($mb);
                    }

                    foreach($documents as $docs => $doc){
                        if(is_uploaded_file($doc->getFile())){
                            $doc->setAssociationsNumassoc($association);
                            $uploaded[] = $doc;
                        }
                    }

                    $em->persist($association);

                    $em->persist($bureau);

                    $em->persist($responsable);

                    if($agrementadministratif != null){
                        $agrementadministratif->setAssociationsNumassoc($association);
                        $em->persist($agrementadministratif);
                    }

                    if($expertcomptable != null){
                        $expertcomptable->setAssociationsNumassoc($association);
                        $em->persist($expertcomptable);
                    }

                    if($affiliation != null){
                        $affiliation->setAssociationsNumassoc($association);
                        $em->persist($affiliation);
                    }

                    foreach($uploaded as $uploads => $up) {
                        $em->persist($up);
                    }

                    $em->flush();

                    // On créé le zip associé
                    $sourcepath = realpath($this->get('kernel')->getRootDir().'/../web/uploads/'.$association->getNumassoc().'/association/');
                    $targetpath = $sourcepath.'/association-'.$association->getNumassoc().'.zip';
                    HZip::zipDir($sourcepath,$targetpath);

                    // Remove all tmp files
                    $tmpfiles = glob($this->get('kernel')->getRootDir().'/../web/uploads/tmp/*'); // get all file names
                    foreach($tmpfiles as $tmpfile){ // iterate files
                        if(is_file($tmpfile))
                            unlink($tmpfile); // delete file
                    }

                    $this->get('session')->getFlashBag()
                        ->add('success','L\'association '.$association->getNom().' a été enregistrée avec succès !');

                    return $this->redirectToRoute('AssociationBundle_homepage');

                }
                else return $this->render('AssociationBundle:Association:association.html.twig', array('form' => $form->createView(),'accueil' => false));
            }
            else return $this->redirectToRoute('AssociationBundle_homepage');
        }

        return $this->redirectToRoute('AssociationBundle_homepage');
    }

    public function updateAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
        {
            // redirect authenticated admin to homepage
            return $this->redirectToRoute('AdminBundle_homepage');
        }
        else if ($this->get('security.authorization_checker')->isGranted('ROLE_USER'))
        {
            $user = $this->getUser();

            $em = $this->getDoctrine()->getManager();
            $association = $em->getRepository('AssociationBundle:Associations')->findOneBy(array('users' => $user));

            if (!$association)
                return $this->redirectToRoute('AssociationBundle_association');
            else
            {
                // 1) build the form
                $form = $this->get('form.factory')->createBuilder(new UpdateFormType())
                    ->getForm();

                $responsable = $em->getRepository('AssociationBundle:Responsables')->findOneBy(array('associationsNumassoc' => $association)) == null ? new Responsables() : $em->getRepository('AssociationBundle:Responsables')->findOneBy(array('associationsNumassoc' => $association));
                $affiliation = $em->getRepository('AssociationBundle:Affiliations')->findOneBy(array('associationsNumassoc' => $association)) == null ? new Affiliations() : $em->getRepository('AssociationBundle:Affiliations')->findOneBy(array('associationsNumassoc' => $association));
                $expertcomptable = $em->getRepository('AssociationBundle:Expertscomptable')->findOneBy(array('associationsNumassoc' => $association)) == null ? new Expertscomptable() : $em->getRepository('AssociationBundle:Expertscomptable')->findOneBy(array('associationsNumassoc' => $association));
                $agrementadministratif = $em->getRepository('AssociationBundle:Agrementsadministratifs')->findOneBy(array('associationsNumassoc' => $association)) == null ? new Agrementsadministratifs() : $em->getRepository('AssociationBundle:Agrementsadministratifs')->findOneBy(array('associationsNumassoc' => $association));
                $bureau = $em->getRepository('AssociationBundle:Bureaux')->findOneBy(array('associationsNumassoc' => $association));

                $categoriesadherents = $em->getRepository('AssociationBundle:Categoriesadherents')->findBy(array('associationsNumassoc' => $association));
                $membresbureau = $em->getRepository('AssociationBundle:Membresbureau')->findBy(array('bureaux' => $bureau));
                $membresconseil = $em->getRepository('AssociationBundle:Membresconseiladministration')->findBy(array('associationsNumassoc' => $association));
                $documents_registered = $em->getRepository('DocumentBundle:Documents')->findBy(array('associationsNumassoc' => $association));

                $form['association']->setData($association);
                $form['responsable']->setData($responsable);
                $form['affiliation']->setData($affiliation);
                $form['bureau']->setData($bureau);
                $form['expertcomptable']->setData($expertcomptable);
                $form['agrementadministratif']->setData($agrementadministratif);
                $form['categorieadherent']->setData($categoriesadherents);
                $form['membrebureau']->setData($membresbureau);
                $form['membreconseiladministration']->setData($membresconseil);
                $form['documents']->setData($this->setDocumentsAssociation());

                // 2) handle the submit (will only happen on POST)
                if ($form->handleRequest($request)->isValid())
                {
                    // Removing the old documents
                    foreach($documents_registered as $doc) {
                        $em->remove($doc);
                    }

                    // Remove recursively the association's folder
                    $fs = new Filesystem();
                    $fs->remove($this->get('kernel')->getRootDir() . '/../web/uploads/'.$association->getNumassoc());

                    // Set Agrement administratif
                    if ($agrementadministratif->getAttribuepar() == null && $agrementadministratif->getDateattribution() == null) {
                        $em->remove($agrementadministratif);
                        $agrementadministratif = null;
                    } else {
                        $agrementadministratif->setAssociationsNumassoc($association);

                    }

                    // Set Affiliation
                    if ($affiliation->getNumeroagrement() == null && $affiliation->getOrganisme() == null) {
                        $em->remove($affiliation);
                        $affiliation = null;
                    } else {
                        $affiliation->setAssociationsNumassoc($association);
                    }

                    // Set Expert comptable
                    if ($expertcomptable->getNom() == null && $expertcomptable->getPrenom() == null && $expertcomptable->getAdresse() == null && $expertcomptable->getMail() == null && $expertcomptable->getTelephone() == null) {
                        $em->remove($expertcomptable);
                        $expertcomptable = null;
                    } else {
                        $expertcomptable->setAssociationsNumassoc($association);
                    }

                    $documents = $form['documents']->getData();

                    // Set Membresconseil, membresbureau and categoriesadherents : nécessaire de faire un get data du form pour récupérer les données AJOUTEES
                    $categoriesadherents = $form['categorieadherent']->getData();
                    foreach($categoriesadherents as $categorieadherents => $ca) {
                        if($ca->getResidence() == null) {
                            $em->remove($ca);
                            unset($categoriesadherents[$categorieadherents]);
                        } else {
                            $ca->setAssociationsNumassoc($association);
                            $em->persist($ca);
                        }
                    }

                    $membresconseil = $form['membreconseiladministration']->getData();
                    foreach($membresconseil as $membreconseil => $mc) {
                        if ($mc->getNom() == null && $mc->getPrenom() == null && $mc->getCommuneResidence() == null && $mc->getProfession() == null){
                            $em->remove($mc);
                            unset($membresconseil[$membreconseil]);
                        } else {
                            $mc->setAssociationsNumassoc($association);
                            $em->persist($mc);
                        }
                    }

                    $membresbureau = $form['membrebureau']->getData();
                    foreach($membresbureau as $membrebureau => $mb) {
                        if($mb->getRoles() == null ) {
                            $em->remove($mb);
                            unset($membresbureau[$membrebureau]);
                        } else {
                            $mb->setBureaux($bureau);
                            $em->persist($mb);
                        }
                    }

                    $em->flush();

                    $recap = $this->createRecapAssociation($association,$bureau,$affiliation,$expertcomptable,$categoriesadherents,$membresbureau,$membresconseil,$agrementadministratif,$responsable);

                    // Documents qui ont été uploadés
                    $uploaded[] = $recap;

                    foreach($documents as $docs => $doc){
                        if(is_uploaded_file($doc->getFile())){
                            $doc->setAssociationsNumassoc($association);
                            $uploaded[] = $doc;
                        }
                    }

                    // On ajoute les documents à l'association
                    $association->setDocuments($uploaded);

                    foreach($uploaded as $uploads => $up) {
                        $em->persist($up);
                    }

                    $em->flush();

                    // On créé le zip associé
                    $sourcepath = realpath($this->get('kernel')->getRootDir().'/../web/uploads/'.$association->getNumassoc().'/association/');
                    $targetpath = $sourcepath.'/association-'.$association->getNumassoc().'.zip';
                    HZip::zipDir($sourcepath,$targetpath);

                    // Remove all tmp files
                    $tmpfiles = glob($this->get('kernel')->getRootDir().'/../web/uploads/tmp/*'); // get all file names
                    foreach($tmpfiles as $tmpfile){ // iterate files
                        if(is_file($tmpfile))
                            unlink($tmpfile); // delete file
                    }

                    $this->get('session')->getFlashBag()
                        ->add('success','L\'association '.$association->getNom().' a été modifiée avec succès !');
                }
                else return $this->render('AssociationBundle:Association:update-association.html.twig', array('form' => $form->createView(),'accueil' => false));
            }
        }

        return $this->redirectToRoute('AssociationBundle_homepage');
    }


    public function setDocumentsAssociation()
    {
        // Les différents fichiers qui seront uploadés lors de l'enregistrement de l'association
        $statuts = new Documents();
        $statuts->setObjet('statuts');

        $recepisse = new Documents();
        $recepisse->setObjet('recepisse');

        $crag = new Documents();
        $crag->setObjet('compterendu_assembleegenerale');

        $ribrip = new Documents();
        $ribrip->setObjet('ribrip');

        $infosadherents = new Documents();
        $infosadherents->setObjet('infosadherents');

        return $documents = [$statuts,$recepisse,$crag,$ribrip,$infosadherents];
    }

    public function createRecapAssociation($association,$bureau,$affiliation,$expertcomptable,$categoriesadherents,$membresbureau,$membresconseil,$agrementadministratif,$responsable) {
        // Création du PDF récapitulatif de l'association
        $recap = new Documents();
        $recap->setObjet('recapitulatif-association');
        $recap->setNom('assoc-'.$association->getNumassoc().'-'.date('Y'));
        $recap->setAssociationsNumassoc($association);
        $path = $recap->getAssociationsNumassoc()->getNumassoc().'/association/'.$recap->getObjet().'/'.$recap->getNom().'.pdf';
        $recap->setPath($path);

        // On genère la vue à convertir en PDF, en n'oubliant pas les paramètres twig si la vue comporte des données dynamiques
        $file = $this->get('knp_snappy.pdf');

        // On save la session
        $session = $this->getRequest()->getSession();
        $session->save();
        $file->generateFromHtml(
            $this->renderView(
                'AssociationBundle:PDF:association-pdf.html.twig',
                array(
                    'association'           => $association,
                    'bureau'                => $bureau,
                    'affiliation'           => $affiliation,
                    'expertcomptable'       => $expertcomptable,
                    'categoriesadherents'   => $categoriesadherents,
                    'membresbureau'         => $membresbureau,
                    'membresconseil'        => $membresconseil,
                    'agrementadministratif' => $agrementadministratif,
                    'responsable'           => $responsable,
                    'cookie' => array($session->getName() => $session->getId()),
                    'disable-javascript' => true
                )
            ),
            $this->get('kernel')->getRootDir() . '/../web/uploads/'.$path
        );

        return $recap;
    }

    public function testPDFAction() {
        // On genère la vue à convertir en PDF, en n'oubliant pas les paramètres twig si la vue comporte des données dynamiques
        $file = $this->get('knp_snappy.pdf');

        // On save la session
        $session = $this->getRequest()->getSession();
        $session->save();
        $file->generateFromHtml(
            $this->renderView(
                'AssociationBundle:PDF:association-pdf-test.html.twig'
            ),
            $this->get('kernel')->getRootDir() . '/../web/uploads/association-pdf-test.pdf'
        );

        return $this->render('AssociationBundle:PDF:association-pdf-test.html.twig');
    }

}