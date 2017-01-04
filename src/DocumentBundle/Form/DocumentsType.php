<?php

namespace DocumentBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\FileType;;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocumentsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom','text',array('read_only' => true))
            ->add('file','file')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DocumentBundle\Entity\Documents'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'documentbundle_documents';
    }
}
