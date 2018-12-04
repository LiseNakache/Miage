<?php

namespace MS\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use MS\PlatformBundle\Entity\Student;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
//Pour imbriquer une selection dans le formulaire
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CourseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type',  TextType::class)
            ->add('name',  TextType::class, array(
                'label'  => 'Nom'
            ))
            ->add('dateStart',  DateType::class, array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'label'  => 'Début Année Universitaire',
                'attr' => array('placeholder' => 'jj/mm/aaaa'),
                ))

            ->add('dateEnd',  DateType::class, array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'label'  => 'Fin Année Universitaire',
                'attr' => array('placeholder' => 'jj/mm/aaaa'),
            ))
            ->add('students', EntityType::class, array(
                'class'        => 'MSPlatformBundle:Student',
                'choice_label' => function (Student $student) {
                                return $student->getFirstName() . ' ' . $student->getLastName();},
                'multiple'     => true,
                'expanded'     => true,
                'label'  => 'Etudiants'
            ))
            ->add('subjects', EntityType::class, array(
                'class'        => 'MSPlatformBundle:Subject',
                'choice_label' => 'name',
                'multiple'     => true,
                'expanded'     => true,
                'label'  => 'Matières',
            ))

            ->add('save',      SubmitType::class, array(
                'label'  => 'Sauvegarder'
            ));
    }




    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MS\PlatformBundle\Entity\Course'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ms_platformbundle_course';
    }


}
