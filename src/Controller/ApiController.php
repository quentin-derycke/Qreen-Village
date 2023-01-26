<?php
 namespace App\Controller;

use App\Services\OrderService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class ApiController extends AbstractController {




    #[Route('/api/RevenueByYear/{year}', methods: ['GET'])]
public function SalesByYear($year, OrderService $orderService ): Response{
    
      $salesByYear = $orderService->getOrderByYear($year);

    return new Response(json_encode($salesByYear), 200, ["Content-Type" => "application/json"]);

}



}
