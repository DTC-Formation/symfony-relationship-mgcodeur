<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Valid;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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
                'constraints' => [
                    new Valid(),
                ],
                'required' => false,
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'Veuillez Entrez votre prénom',
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new Valid(),
                ],
                'required' => false,
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
                'constraints' => [
                    new Valid(),
                ],
                'html5' => true,
                'required' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
            ])
            ->add('reset', ResetType::class, [
                'label' => 'Annuler',
                'attr' => [
                    'class' => 'btn btn-danger mr-2',
                ],
            ])
            ->add('address', AddressType::class, [
                'label' => false,
                'required' => false,
                'constraints' => [
                    new Valid(),
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
