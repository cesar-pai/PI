<?php

namespace AssociationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoriesadherentsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categorie','text')
            ->add('trancheAge','text',array('required'  =>  false))
            ->add('nombre','text')
            ->add('niveau','text',array('required'  =>  false))
            ->add('residence','choice', array(
                'choices'   => [
                    'Extérieur'     =>  'Extérieur',
                    'Villarois'     =>  'Villarois',
                    'Sans importance'  =>  'Sans importance'
                ]
            ))
            ->add('montantcotisation','text')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AssociationBundle\Entity\Categoriesadherents'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'associationbundle_categoriesadherents';
    }
}
