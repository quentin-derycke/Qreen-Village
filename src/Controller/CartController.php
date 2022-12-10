<?php

namespace App\Controller;

use App\Form\CartType;
use App\Entity\Address;
use App\Form\AddressType;
use App\Manager\CartManager;
use App\Repository\AddressRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
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
        AddressRepository $addressRepository,
        UserInterface $user
    ): Response {

        $address = new Address();
        $address->setUser($user);
        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $addressRepository->save($address, true);

            return $this->redirectToRoute('user_profil', [], Response::HTTP_SEE_OTHER);
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