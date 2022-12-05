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
        ->add('houseNumber', TextType::class)
        ->add('street', TextType::class)
        ->add('city', TextType::class)
        ->add('zipcode', TextType::class)
    ->add('save', SubmitType::class)
    ->getForm();
    }
}