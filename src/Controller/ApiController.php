<?php
 namespace App\Controller;

use App\Repository\OrderRepository;
use App\Services\OrderService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class ApiController extends AbstractController {




    #[Route('/api/RevenueByYear/{year}', methods: ['GET'])]
public function SalesByYear($year, OrderRepository $orderRepository, OrderService $orderService ): Response{
    
    dd($orderService->getOrderByYear($year));
    return new Response(json_encode(["pute" => true]), 200, ["Content-Type" => "application/json"]);

}



}
