<?php

namespace App\Controller;

use App\Manager\CartManager;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NavController extends AbstractController
{
    public function index(CategoryRepository $repo, CartManager $cartManager,): Response
    {
        $liste = $repo->findAll();
        $cart = $cartManager->getCurrentCart();
       
        return $this->render('partials/_navbar.html.twig', [
            'liste_categories' => $liste,
            'navCart' => $cart
        ]);
    }
}
