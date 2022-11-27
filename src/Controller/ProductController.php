<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/product', name: 'product')]
class ProductController extends AbstractController
{
    #[Route('/{category}', name: '_category')]
    public function index(Category $category): Response
    {

        $products = $category->getCategory();

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'category' => $category
        ]);
    }
}
