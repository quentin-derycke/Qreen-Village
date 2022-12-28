<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/category', name: 'category')]
class CategoryController extends AbstractController
{
    #[Route('/', name: '_index')]
    public function index(CategoryRepository $repository): Response
    {


        $categories = $repository->findAll();


        return $this->render('category/index.html.twig', [
            'categories' =>  $categories,

        ]);
    }
    #[Route('/{category}', name: '_subcategories')]
    public function subcategory(Category $category): Response
    {
        return $this->render('category/subcategories.html.twig', [
            'categories' => $category->getParent(),
            'category' => $category,


        ]);
    }
}