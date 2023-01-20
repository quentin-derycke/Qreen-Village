<?php

namespace App\Form;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints as Assert;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('houseNumber', TextType::class, [
                'attr' => [
                    'class' => 'form-control mt-4',

                ],
                'label' => 'House Number',
                'label_attr' => ['class' => 'form-label mt-4'],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Regex([
                        'pattern' => '/^\d+[a-zA-Z]?$/',
                        'message' => ' Indiquer un Numéro valide',
                    ])
                ]
            ])
            ->add('street', TextType::class, [
                'attr' => [
                    'class' => 'form-control mt-4',

                ],
                'label' => 'Street',
                'label_attr' => ['class' => 'form-label mt-4'],
                'constraints' => [
                    new Assert\NotBlank(),
                  
                ]
            ])

            ->add('zipcode', TextType::class,  [
                'attr' => [
                    'class' => 'form-control mt-4',
                ],
                'label' => 'Zipcode',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Regex([
                        'pattern' => '/^[0-9]{5}$/',
                        'message' => 'Indiquer un Code postal Français',
                    ])
                ]
            ])

            ->add('city', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-control mt-4',
                ],

                'label' => 'City',
                'label_attr' => ['class' => 'form-label mt-4']
            ])
            ->addEventListener(
                FormEvents::PRE_SUBMIT,
                [$this, 'onPreSubmit']
            )

            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary mt-4']
            ])
            ->getForm();
    }
    public function onPreSubmit(FormEvent $event)
    {
        $input = $event->getData()['city'];
        $event->getForm()->add(
            'city',
            ChoiceType::class,
            ['choices' => [$input]]
        );
    }
}
