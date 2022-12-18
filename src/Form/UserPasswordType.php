<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserPasswordType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plainPassword', RepeatedType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['min' => 8, 'max' => 50]),
                    new Assert\Regex([
                        'pattern' => '/^(?=.*[0-9])(?=.*[A-Z])(?=.{8,})/',
                        'message' => 'Le mot de passe doit contenir au moins un chiffre, une majuscule et 8 caractères',
                    ]),
                ],
                'type' => PasswordType::class,
                'first_options' =>
                [

                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'label' => 'Mot de passe',
                    'label_attr' => [
                        'class' => 'form-label mt-4'
                    ],
                ],
                'second_options' => [

                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'label' => 'Confirmation du MDP',
                    'label_attr' => [
                        'class' => 'form-label mt-4'
                    ],
                ],
                'invalid_message' => 'les mdps ne correspondent pas'
            ])
            ->add('newPassword', PasswordType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['min' => 8, 'max' => 50]),
                    new Assert\Regex([
                        'pattern' => '/^(?=.*[0-9])(?=.*[A-Z])(?=.{8,})/',
                        'message' => 'Le mot de passe doit contenir au moins un chiffre, une majuscule et 8 caractères',
                    ]),
                ],
                'attr' => ['class' => 'form-control'],
                'label' => 'Nouveau mot de passe',
                'label_attr' => ['class' => 'form-label mt-4'],

            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4'
                ],
                'label' => 'Changer de mot de passe'
            ]);
    }
}
