<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/category{category}/product', name: 'product')]
class ProductController extends AbstractController
{

    #[Route('/', name: '_category')]
    public function index(Category $category): Response
    {

        $products = $category->getProducts();

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'category' => $category
        ]);
    }
    #[Route('/details/{id}', name: '_details')]
    public function detail(ProductRepository $productRepository, CategoryRepository $categoryRepository,  int $id): Response
    {
        $category = $categoryRepository->find($id);
        $product = $productRepository->find($id);


        return $this->render('product/details.html.twig', [
            'product' => $product,
            'category' => $category


        ]);
    }
}
