<?php

namespace App\Controller;

use App\Entity\Address;
use App\Form\AddressType;
use App\Repository\AddressRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/address')]
class AddressController extends AbstractController
{
    #[Security("is_granted('ROLE_USER') and user === user ")]
    #[Route('/new', name: 'address_new', methods: ['GET', 'POST'])]

    public function add(
        AddressRepository $addressRepository,
        Request $request,
        UserInterface $user

    ) {
        if (!$this->getUser()) {
            return $this->redirectToRoute('security_login');
        }

        $address = new Address();
        $address->setUser($user);
        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $addressRepository->save($address, true);
            $this->addFlash(
                'success',
                'Nouvelle Adresse est enregistré.'
            );

            return $this->redirectToRoute('user_profil', [], Response::HTTP_SEE_OTHER);
        } else {
            $this->addFlash(
                'warning',
                "Votre addresse est incorrecte"
            );
        }
        return $this->render('address/new.html.twig', [
            'address' => $address,
            'form' => $form->createView(),
        ]);
    }


    #[Route('/{id}', name: 'address', methods: ['GET', 'POST'])]
    public function edit(

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