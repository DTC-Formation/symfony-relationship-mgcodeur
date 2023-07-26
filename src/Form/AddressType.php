<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Constraints\Length;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('batch', TextType::class, [
                'label' => 'Lot',                
                'attr' => [
                    'placeholder' => 'Veuillez Entrer le lot de votre batiment',
                    'class' => 'form-control',
                ],
                'required' => false
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                
                'attr' => [
                    'placeholder' => 'Veuillez Entrer votre ville',
                    'class' => 'form-control',
                ],
                'required' => false
            ])
            ->add('postalCode', TextType::class, [
                'label' => 'Code Postal',
                
                'attr' => [
                    'placeholder' => 'Veuillez Entrer votre code postal',
                    'class' => 'form-control',
                ],
                'required' => false
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
