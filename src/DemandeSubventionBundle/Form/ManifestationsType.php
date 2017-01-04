<?php

namespace DemandeSubventionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ManifestationsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom','text')
            ->add('date','date')
            ->add('theme','text',array('required' => false))
            ->add('public','text',array('required' => false))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DemandeSubventionBundle\Entity\Manifestations'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'demandesubventionbundle_manifestations';
    }
}
