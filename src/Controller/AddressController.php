<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Address;
use App\Form\AddressType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddressController extends AbstractController
{
    #[Route('/address/{id}', name: 'address', methods: ['GET', 'POST'])]
    public function index(
       
        Request $request,
        EntityManagerInterface  $manager,
        Address $address
    ): Response {
        if (!$this->getUser()) {
            return $this->redirectToRoute('security_login');
        }

     


        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);
        if ($form->isSubmitted() &&  $form->isValid()) {

            $address = $form->getData();
            $manager->persist($address);
            $manager->flush();
        }


        return $this->render('address/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
