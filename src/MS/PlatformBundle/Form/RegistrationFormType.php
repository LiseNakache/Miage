<?php

namespace MS\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name',  TextType::class, array(
                'label'  => 'Prénom'
            ))
            ->add('last_name',  TextType::class, array(
                'label'  => 'Nom'
            ))
            ->add('roles', ChoiceType::class, array(
                'choices' => array(
                    'Administrateur' => 'ROLE_ADMIN',
                    'Professeur' => 'ROLE_TEACHER',
                    'Etudiant' => 'ROLE_STUDENT'
                ),
                'expanded' => true,
                'multiple'=>true
            ))
            ->remove('username');
    }

    public function getParent()
    {
        return BaseRegistrationFormType::class;
    }
}