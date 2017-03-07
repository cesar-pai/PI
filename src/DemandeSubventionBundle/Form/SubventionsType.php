<?php

namespace DemandeSubventionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubventionsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $currentyear = intval(date('m') <= 2 ? date('Y') : date('Y') + 1);
        $builder
            ->add('annee','choice', array(
                'choices'   =>  [
                    $currentyear - 3   =>  $currentyear - 3,
                    $currentyear - 2   =>  $currentyear - 2,
                    $currentyear - 1   =>  $currentyear - 1,
                    $currentyear       =>  $currentyear
                ]
            ))
            ->add('montant','text')
            ->add('recue','checkbox',array('required'   =>  false))
            ->add('demandee','checkbox',array('required'   =>  false))
            ->add('organisme','text')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DemandeSubventionBundle\Entity\Subventions'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'demandesubventionbundle_subventions';
    }
}
