<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Veuillez Entrez votre nom',
                    'class' => 'form-control',
                ],
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'Veuillez Entrez votre prénom',
                    'class' => 'form-control',
                ],
            ])
            ->add('age', NumberType::class, [
                'label' => 'Age',
                'attr' => [
                    'placeholder' => 'Votre âge',
                    'class' => 'form-control',
                    'min' => '1',
                    'max' => '99',
                    'step' => '1',
                    'value' => '1',
                    'pattern' => '[0-9]+'
                ],
                'html5' => true,
            ])
            // add submit button
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
            ])
            // add reset button
            ->add('reset', ResetType::class, [
                'label' => 'Annuler',
                'attr' => [
                    'class' => 'btn btn-danger mr-2',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
