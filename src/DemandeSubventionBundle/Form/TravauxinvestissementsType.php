<?php

namespace DemandeSubventionBundle\Form;

use DocumentBundle\Form\DocumentsType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TravauxinvestissementsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nature','text',array('required'   =>  false))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DemandeSubventionBundle\Entity\Travauxinvestissements'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'demandesubventionbundle_travauxinvestissements';
    }
}
