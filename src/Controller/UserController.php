<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserEditType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    #[Route('/user/edit/{id}', name: 'user_edit')]
    public function edit(User $user, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher): Response
    {

        if (!$this->getUser()) {
            return $this->redirectToRoute('security_login');
        }

        if ($this->getUser() !== $user) {
            return $this->redirectToRoute("category_index");
        }

        
        $form = $this->createForm(UserEditType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() &&  $form->isValid()) {
           

                $user = $form->getData();
                $manager->persist($user);
                $manager->flush();

                $this->addFlash(
                    'success',
                    'Modification réussi'
                );
                return $this->redirectToRoute('category_index');
            } 
        return $this->render('user/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
