<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route('/order/{id}', name: 'order')]
    public function index(OrderRepository $orderRepository, int $id ): Response
    {
        $order =  $orderRepository->findById($id);
        return $this->render('order/index.html.twig', [
            'order' => $order,
        ]);
    }
}
