<?php

namespace App\Form;

use App\Entity\Order;
use App\Entity\Address;
use App\Repository\AddressRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class OrderType extends AbstractType
{

    private $token;

    public function __construct(TokenStorageInterface $token)
    {
        $this->token = $token;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('address', EntityType::class, [
                'class' => Address::class,
                'query_builder' => function (AddressRepository $er) {
                    return $er->createQueryBuilder('a')
                        ->where('a.user = :user')
                        ->orderBy('a.houseNumber', 'ASC')
                        ->setParameter('user', $this->token->getToken()->getUser());
                },
                'attr' => [ 'class' => 'form-control'],
                'label' => "Delivery Address",
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'choice_label' => function (Address $address) {
                    return $address->getHouseNumber() . ' ' .
                        $address->getStreet()
                        . ' ' . $address->getCity()
                        . ' ' . $address->getZipcode();
                },
                'multiple' => false,
                'expanded' => false
            ],)->add(
                'submit',
                SubmitType::class,
                [
                    'attr' => [
                        'class' => 'btn btn-primary my-4'
                    ],
                    'label' => 'Enregistrer'
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}