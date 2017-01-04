<?php

namespace DemandeSubventionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use DocumentBundle\Form\DocumentsType;

class DemandeFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('demandesubvention', new DemandessubventionType())
            ->add('persencharge', new PersonnesenchargeType())
            ->add('bilanactivite',new BilansactiviteType())
            ->add('travauxinvestissement',new TravauxinvestissementsType(), array('required' => false))
            ->add('actions', 'collection', array(
                'type'          => new ActionsType(),
                'allow_add'     => true,
                'required'      => false,
                'label'         => false,
                'by_reference'  => false
            ))
            ->add('subventions', 'collection', array(
                'type'          => new SubventionsType(),
                'allow_add'     => true,
                'required'      => false,
                'label'         => false,
                'by_reference'  => false
            ))
            ->add('miseadispo', 'collection', array(
                'type'          => new MiseadispositionType(),
                'allow_add'     => true,
                'required'      => false,
                'label'         => false,
                'by_reference'  => false
            ))
            ->add('faitsmarquants', 'collection', array(
                'type'         => new FaitsmarquantsType(),
                'allow_add'     => true,
                'required'      => false,
                'label'         => false,
                'by_reference'  => false
            ))
            ->add('manifestations', 'collection', array(
                'type'          => new ManifestationsType(),
                'allow_add'     => true,
                'required'      => false,
                'label'         => false,
                'by_reference'  => false
            ))
            ->add('documents', 'collection', array(
                'type'          => new DocumentsType(),
                'allow_add'     => true,
                'required'      => false,
                'label'         => false
            ))

        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'associationbundle_registrationform';
    }
}
