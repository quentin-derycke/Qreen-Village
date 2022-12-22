<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use App\Form\AddToCartType;
use App\Manager\CartManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/product', name: 'product')]
class ProductController extends AbstractController
{
    #[Route('/{category}', name: '_category')]
    public function index(Category $category): Response
    {

        $products = $category->getProducts();

       
        return $this->render('product/index.html.twig', [
            'products' => $products,
            'category' => $category
        ]);
    }
    #[Route('/details/{id}', name: '_details')]
    public function detail(
        Product $product,
        Request $request,
        CartManager $cartManager
    ): Response {



        $form = $this->createForm(AddToCartType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $item = $form->getData();
            $item->setProduct($product);

            $cart = $cartManager->getCurrentCart();
            $cart
                ->addItem($item)
                ->setUpdatedAt(new \DateTime());

            $cartManager->save($cart);
            $this->addFlash(
                'success',
                'Produit ajouté au panier.'
            );
            return $this->redirectToRoute('product_details', ['id' => $product->getId()]);
        }

        return $this->render('product/details.html.twig', [
            'product' => $product,
            'form' => $form->createView()
        ]);
    }
}