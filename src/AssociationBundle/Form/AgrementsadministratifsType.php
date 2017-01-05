<?php

namespace AssociationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgrementsadministratifsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeagrement','text')
            ->add('attribuepar','text')
            ->add('dateattribution','collot_datetime',array('required' =>  false,'pickerOptions' =>
                array('format' => 'dd/mm/yyyy','minView' => 'month',
                    'maxView' => 'decade')))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AssociationBundle\Entity\Agrementsadministratifs'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'associationbundle_agrementsadministratifs';
    }
}
