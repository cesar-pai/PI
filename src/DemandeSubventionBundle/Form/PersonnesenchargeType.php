<?php

namespace DemandeSubventionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonnesenchargeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom','text')
            ->add('prenom','text')
            ->add('qualite','text',array('required'   =>  false))
            ->add('adresse','text',array('required'   =>  false))
            ->add('mail','text',array('required' => false))
            ->add('telephone','text',array('required'   =>  false));
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DemandeSubventionBundle\Entity\Personnesencharge'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'demandesubventionbundle_personnesencharge';
    }
}
