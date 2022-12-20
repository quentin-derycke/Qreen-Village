<?php

namespace App\Controller;

use App\Entity\Order;
use App\Manager\CartManager;
use App\Factory\OrderFactory;
use App\Repository\OrderRepository;
use App\Storage\CartSessionStorage;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class OrderController extends AbstractController
{
    #[Route('/order/{id}', name: 'order')]
    public function index(OrderRepository $orderRepository, EntityManagerInterface $manager,
    OrderFactory $orderFactory,int $id,  UserInterface $user, ): Response
    {
        

        // On met à jour le statut de la commande 
        $order =  $orderRepository->findOneById($id);
       $orderFactory->edit($order);

$order->setUser($user);
        $manager->persist($order);
        $manager->flush();

// On  la lie à l'utilisateur : 


        return $this->render('order/index.html.twig', [
            'order' => $order,
        ]);
    }

    
    
}
