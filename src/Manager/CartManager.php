<?php

namespace App\Manager;

use App\Entity\Order;
use App\Factory\OrderFactory;
use App\Storage\CartSessionStorage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class CartManager
{
    /**
     * @var CartSessionStorage
     */
    private $cartSessionStorage;
    
    /**
     * @var OrderFactory
     */
    public $cartFactory;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * CartManager constructor.
     */
    public function __construct(
        CartSessionStorage $cartStorage,
        OrderFactory $orderFactory,
        EntityManagerInterface $entityManager
    ) {
        $this->cartSessionStorage = $cartStorage;
        $this->cartFactory = $orderFactory;
        $this->entityManager = $entityManager;
    }

    /**
     * Gets the current cart.
     */
    public function getCurrentCart(): Order
    {
        $cart = $this->cartSessionStorage->getCart();

        if (!$cart) {
            $cart = $this->cartFactory->create();
        }

        return $cart;
    }

    /**
     * Persists the cart in database and session.
     */
    public function save(Order $cart): void
    {
        // Persist in database
        $this->entityManager->persist($cart);
        $this->entityManager->flush();
        // Persist in session
        $this->cartSessionStorage->setCart($cart);
    }


    /**
     * Edits an order with a new status and address.
     *
     * @param Order $order Id Object of order  
     *
     * @return Order
     */
    public function edit( Order $order, UserInterface $user): void
    {
        $order->setStatus(Order::STATUS_CHECK);
        $order->setUpdatedAt(new \DateTime());
         $order->setUser($user);   
         $this->entityManager->persist($order);
         $this->entityManager->flush();
    }

}