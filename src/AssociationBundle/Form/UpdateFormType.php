<?php

namespace AssociationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use DocumentBundle\Form\DocumentsType;

class UpdateFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('association', new AssociationsType())
            ->add('responsable', new ResponsablesType())
            ->add('agrementadministratif', new AgrementsadministratifsType(), array('required' => false))
            ->add('bureau', new BureauxType(), array('label' => false))
            ->add('expertcomptable', new ExpertscomptableType(),array('required' =>  false))
            ->add('membreconseiladministration', 'collection', array(
                'type'          => new MembresconseiladministrationType(),
                'allow_add'     => true,
                'required'      =>  false,
                'label'         => false,
                'by_reference'  => false
            ))
            ->add('affiliation', new AffiliationsType(), array('required' =>  false))
            ->add('documents', 'collection', array(
                'type'          => new DocumentsType(),
                'allow_add'     => true,
                'required'      => false,
                'label'         => false
            ))
            ->add('categorieadherent', 'collection', array(
                'type'          => new CategoriesadherentsType(),
                'allow_add'     => true,
                'required'      => false,
                'label'         => false,
                'by_reference'  => false
            ))
            ->add('membrebureau', 'collection', array(
                'type'          => new MembresbureauType(),
                'allow_add'     => true,
                'required'      => false,
                'label'         => false,
                'by_reference'  => false
            ))
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'associationbundle_updateform';
    }
}
