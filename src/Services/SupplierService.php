<?php 
namespace App\Services;


use App\Repository\SuppliersRepository;


class SupplierService {
  
  
    /**
     * The cart repository.
     *
     * @var SuppliersRepository
     */
    private SuppliersRepository $supplier;

    function __construct( SuppliersRepository $suppliersRepository) {
      $this->supplier = $suppliersRepository;
     }
     


     function getSalesBySupplier($supplier) {

      return $this->supplier->findBySupplier($supplier);
  
  }


       }






















?>