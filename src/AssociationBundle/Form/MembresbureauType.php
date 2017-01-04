<?php

namespace AssociationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class MembresbureauType extends AbstractType
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
            ->add('adresse','text',array('required'   =>  false))
            ->add('mail','text',array('required' => false))
            ->add('telephone','text',array('required' => false))
            ->add('profession','text',array('required' => false))
            ->add('roles','entity', array(
                'class'     => 'AssociationBundle:Roles',
                'choice_label' => 'nom'
                ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AssociationBundle\Entity\Membresbureau'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'associationbundle_membresbureau';
    }
}
