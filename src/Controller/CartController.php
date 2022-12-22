<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\CartType;
use App\Entity\Address;
use App\Entity\Product;
use App\Form\OrderType;
use App\Form\AddressType;

use App\Manager\CartManager;
use App\Repository\OrderRepository;
use App\Repository\AddressRepository;
use App\Repository\ProductRepository;
use App\Storage\CartSessionStorage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class CartController extends AbstractController
{

    #[Route('/cart', name: 'cart')]
    public function index(CartManager $cartManager, CartSessionStorage $cartSessionStorage, Request $request): Response
    {
        $cart = $cartManager->getCurrentCart();
        $form = $this->createForm(CartType::class, $cart);
        $form->handleRequest($request);


        // If Form submitted, save $cart in Order in DataBase
        if ($form->isSubmitted() && $form->isValid()) {
            $cart->setUpdatedAt(new \DateTime());
            //Save in BDD
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
        UserInterface $user,
        OrderRepository $orderRepository

    ): Response {
        $address = new Address();
        $address->setUser($user);

        // Empty address From
        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $addressRepository->save($address, true);

            return $this->redirectToRoute('user_profil', [], Response::HTTP_SEE_OTHER);
        }

        // Cart de la session
        $cart = $cartManager->getCurrentCart();


        // OrderAddress Form
        $order = $cart;
        $orderAddressForm = $this->createForm(OrderType::class, $order);
        $orderAddressForm->handleRequest($request);

        if ($orderAddressForm->isSubmitted() && $orderAddressForm->isValid()) {
            // On lie l'addresse à l'utilisateur et à l'addresse
            $orderRepository->save($order, true);
            $cartManager->edit($order, $user);


            return $this->redirectToRoute('pay');
        }



        return $this->render('cart/checkout.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'cart' => $cart,
            'form' => $form->createView(),
            'orderAddress' => $orderAddressForm->createView(),


        ]);
    }
    #[Security("is_granted('ROLE_USER')")]
    #[Route('/cart/checkout/pay/', name: 'pay')]
    public function pay(

        OrderRepository $orderRepository,
        UserInterface $user,
        CartManager $cartManager,
        Request $request,
    ): Response {




        // On Récupere la commande
        $order = $orderRepository->findOneBy([
            'user' => $user,
            'status' => Order::STATUS_CHECK
        ]);

        if (!$order) {

            $this->addFlash(
                'danger',
                "Vous n'avez pas de commandes en cours"
            );


            return  $this->redirectToRoute('category_index');
        }

        $orderForm = $this->createForm(OrderType::class, $order);
        $orderForm->handleRequest($request);



        return $this->render('cart/pay.html.twig', [

            'order' => $order,
            'orderForm' => $orderForm->createView()



        ]);
    }
}
