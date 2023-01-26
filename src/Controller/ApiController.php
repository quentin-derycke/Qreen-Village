<?php
 namespace App\Controller;

use App\Services\OrderService;
use App\Services\SupplierService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class ApiController extends AbstractController {




    #[Route('/api/RevenueByYear/{year}', methods: ['GET'])]
public function SalesByYear($year, OrderService $orderService ): Response{
    
      $salesByYear = $orderService->getOrderByYear($year);

    return new Response(json_encode($salesByYear), 200, ["Content-Type" => "application/json"]);

}

#[Route('/api/SalesBySupplier/{supplier}', methods: ['GET'])]
public function SalesBySupplier($supplier, SupplierService $supplierService ): Response{
    
      $salesBySupplier = $supplierService->getSalesBySupplier($supplier);

    return new Response(json_encode($salesBySupplier), 200, ["Content-Type" => "application/json"]);

}

}
