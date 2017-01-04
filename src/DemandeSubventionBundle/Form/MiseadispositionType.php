<?php

namespace DemandeSubventionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MiseadispositionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom','text')
            ->add('adresse','text')
            ->add('freqUtil','text',array('required'   =>  false))
            ->add('horairesUtil','text',array('required'   =>  false))
            ->add('typesmiseadisposition','entity', array(
                'class'     => 'DemandeSubventionBundle:Typesmiseadisposition',
                'choice_label' => 'nom'
            ))
            ->add('appartientVille','checkbox',array('required'   =>  false))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DemandeSubventionBundle\Entity\Miseadisposition'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'demandesubventionbundle_miseadisposition';
    }
}
