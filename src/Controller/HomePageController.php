<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(CategoryRepository $repository): Response
    {

        $categories = $repository->findAll();


        return $this->render('home_page/index.html.twig', [
            'controller_name' => 'Green Village',
            'categories' => $categories
        ]);
    }
}