<?php

namespace App\Controller;

use App\Form\CartType;
use App\Entity\Address;
use App\Form\AddressType;
use App\Manager\CartManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class CartController extends AbstractController
{
   
    #[Route('/cart', name: 'cart')]
    public function index(CartManager $cartManager, Request $request): Response
    {
        $cart = $cartManager->getCurrentCart();
        $form = $this->createForm(CartType::class, $cart);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cart->setUpdatedAt(new \DateTime());
            $cartManager->save($cart);

            return $this->redirectToRoute('cart');
        }

        return $this->render('cart/index.html.twig', [
            'cart' => $cart,
            'form' => $form->createView(),
        ]);
    }
    #[Route('/cart/checkout', name: 'checkout')]
    public function checkout(
        AuthenticationUtils $authenticationUtils,
         CartManager $cartManager,
         Request $request,
         EntityManagerInterface  $manager,
    
         ) : Response{

            $form = $this->createForm(AddressType::class);
            $form->handleRequest($request);
            if ($form->isSubmitted() &&  $form->isValid()) {
    
                $address = $form->getData();
                $manager->persist($address);
                $manager->flush();
            }
         
        $cart = $cartManager->getCurrentCart();
        return $this->render('cart/checkout.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'cart' => $cart,
            'form' => $form->createView()
       
        ]);
    }
}
