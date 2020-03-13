<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;


class RegistryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder->add('name')
            ->add('surname')
            ->add('email')
            ->add('citizenship', CountryType::class)
            ->add('gender', ChoiceType::class, [
                'choices'  => [
                    'Female' => 'Female',
                    'Male' => 'Male',
                ],
            ])
            ->add('affiliation')
            ->add('telephone')
            ->add('interest')
            ->add('title' , ChoiceType::class, [
                'choices'  => [
                    'Professor' => 'Professor',
                    'PostDoc' => 'PostDoc',
                    'Tenure-track' => 'Tenure-track',
                    'PhD Student' => 'PhD Student',
                    'Student' => 'Student',
                ],
            ])
            ->add('advisor')
            ->add('advisorEmail')
            ->add('speaker', ChoiceType::class, [
                'label'    => 'Are you a speaker in a Special Session?',
                'choices'  => [
                    'No' => 'No',
                    'Yes' => 'Yes',
                ],
            ])
            ->add('other', TextareaType::class, [
                'required'   => false,
            ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Registry'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_registry';
    }


}
