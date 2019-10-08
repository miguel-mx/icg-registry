<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
                    'Student' => 'Student',
                ],
            ])
            ->add('advisor');
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
