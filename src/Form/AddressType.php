<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AddressType extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('houseNumber', TextType::class, ['attr' => [
            'class' => 'form-control mt-4'
        ],
        'label' => 'House Number',
        'label_attr' => ['class' => 'form-label mt-4']])
        ->add('street', TextType::class, ['attr' => [
            'class' => 'form-control mt-4'
        ],
        'label' => 'Street',
        'label_attr' => ['class' => 'form-label mt-4']])
        ->add('city', TextType::class, ['attr' => [
            'class' => 'form-control mt-4'
        ],
        'label' => 'City',
        'label_attr' => ['class' => 'form-label mt-4']])
        ->add('zipcode', TextType::class,  ['attr' => [
            'class' => 'form-control mt-4'
        ],
        'label' => 'Zipcode',
        'label_attr' => ['class' => 'form-label mt-4']])
    ->add('save', SubmitType::class, [
        'attr' => ['class' => 'btn btn-primary mt-4']
    ])
    ->getForm();
    }
}