<?php 
namespace App\Services;


use App\Repository\OrderRepository;


class OrderService {
  
  
    /**
     * The cart repository.
     *
     * @var OrderRepository
     */
    private OrderRepository $order;

    function __construct( OrderRepository $orderRepository) {
      $this->order = $orderRepository;
     }
     
     
     function getOrderByYear($year) {

      return $this->order->findByYear($year);

  }
  function getSalesBySupplier($supplier) {

    return $this->order->findBySupplier($supplier);

}




}
















?>