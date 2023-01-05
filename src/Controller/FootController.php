<?php

namespace App\Controller;


use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FootController extends AbstractController
{
    public function index(CategoryRepository $categoryRepository,): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('partials/_footer.html.twig', [
            'list_categories' => $categories,


        ]);
    }
}