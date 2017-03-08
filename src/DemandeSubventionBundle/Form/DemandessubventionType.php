<?php

namespace DemandeSubventionBundle\Form;

use AssociationBundle\Form\AssociationsType;
use DocumentBundle\Form\DocumentsType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandessubventionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $activites = ['Loto' => 'Loto','Repas dansant ou autre' => 'Repas dansant ou autre','Droit d\'entrée' => 'Droit d\'entrée','Buvette' => 'Buvette','Belote' => 'Belote','Salon' => 'Salon','Centre de loisirs' => 'Centre de loisirs','Tournois' => 'Tournois','Brocante/vide grenier' => 'Brocante/vide grenier','Autres' => 'Autres'];
        $builder
            ->add('montantSubvention','text')
            ->add('activitespayantes','choice',array(
                'choices'       =>  $activites,
                'required'      =>  false,
                'multiple'      =>  true,
                'expanded'      =>  true,
                'choice_label'  =>  function($value){
                    return $value;
                }
            ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DemandeSubventionBundle\Entity\Demandessubvention'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'demandesubventionbundle_demandessubvention';
    }
}
