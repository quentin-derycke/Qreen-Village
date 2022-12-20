<?php

namespace App\Controller;

use App\Entity\Order;
use App\Factory\OrderFactory;
use App\Manager\CartManager;
use App\Repository\OrderRepository;
use App\Storage\CartSessionStorage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class OrderController extends AbstractController
{
    #[Route('/order/{id}', name: 'order')]
    public function index(OrderRepository $orderRepository, AuthenticationUtils $authenticationUtils,
    OrderFactory $orderFactory, CartSessionStorage $cartSessionStorage, int $id, ): Response
    {
        

        // On met à jour le statut de la commande 
        $order =  $orderRepository->findOneById($id);
        $order->setStatus(Order::STATUS_CHECK);
        $order->setUpdatedAt(new \DateTime());


// On  la lie à l'utilisateur : 


        return $this->render('order/index.html.twig', [
            'order' => $order,
        ]);
    }
}
