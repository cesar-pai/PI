<?php

namespace AssociationBundle\Form;
use ClassesWithParents\D;
use DocumentBundle\Form\DocumentsType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UserBundle\Entity\Users;
use UserBundle\Form\UsersType;

class AssociationsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('numassoc', 'text')
            ->add('nom', 'text')
            ->add('sigle', 'text',array('required' => false))
            ->add('datecrea', 'collot_datetime', array('pickerOptions' =>
                array('format' => 'dd/mm/yyyy','minView' => 'month',
                    'maxView' => 'decade')))
            ->add('objet', 'textarea')
            ->add('adresse', 'text')
            ->add('telephone', 'text')
            ->add('website', 'text',array('required' => false))
            ->add('horaires', 'text',array('required' => false))
            ->add('datepubjo', 'collot_datetime',array('required' => false,'pickerOptions' =>
                array('format' => 'dd/mm/yyyy','minView' => 'month',
                    'maxView' => 'decade')))
            ->add('villedecl', 'text')
            ->add('datedecl','collot_datetime',array('pickerOptions' =>
                array('format' => 'dd/mm/yyyy','minView' => 'month',
                    'maxView' => 'decade')))
            ->add('siren', 'text',array('required' => false))
            ->add('siret', 'text')
            ->add('dateUtilitepub','collot_datetime',array('required' => false,'pickerOptions' =>
                array('format' => 'dd/mm/yyyy','minView' => 'month',
                    'maxView' => 'decade')))
            ->add('isSportive','checkbox',array('required'  => false))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AssociationBundle\Entity\Associations'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'associationbundle_associations';
    }
}