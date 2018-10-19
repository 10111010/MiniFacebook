<?php

namespace FacebookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AddUSerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom' ,TextType::class , array('label'=> 'Nom'))
            ->add('prenom', TextType::class , array('label'=> 'Prenom'))
            ->add('age'  , NumberType::class , array('label'=> 'Age'))
            ->add('race' ,  ChoiceType::class , array('choices'=> array(
                'Asistique' => 'allergologie',
                'Noir' => 'andrologie',
                'Indien'=>'anesthésiologie' ,
                'Latino' => 'cardiologie' ,
                 'Moyen Orient' => 'Moyen Orient' ,
                'Metisse' => 'Metisse',
                'blanc' => 'blanc')))
            ->add('nourriture' ,  ChoiceType::class , array('choices'=> array(
                'Omnivore' => 'Omnivore',
                'Carnivore' => 'Carnivore',
                'Végétarien'=>'Végétarien' ,
                'Herbivore ' => 'Herbivore ' ,
                'Granivore' => 'Granivore' )));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'ajouter_user_amis';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }

}
