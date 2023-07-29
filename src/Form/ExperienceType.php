<?php

namespace App\Form;

use App\Entity\Experience;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('startDate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de début',
                'html5' => true,
                'attr' => [
                    'class' => 'js-datepicker form-control',
                    'autocomplete' => 'off',
                ],
                'required' => false,
            ])
            ->add('endDate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de fin',
                'html5' => true,
                'attr' => [
                    'class' => 'js-datepicker form-control',
                    'autocomplete' => 'off',
                ],
                'required' => false,
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom de l\'expérience',
                'attr' => [
                    'placeholder' => 'Nom de l\'expérience',
                    'class' => 'form-control',
                ],
                'required' => false,
                'label_attr' => [
                    'class' => 'mt-3',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Experience::class,
        ]);
    }
}