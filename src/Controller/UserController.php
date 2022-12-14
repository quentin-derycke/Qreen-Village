<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\UserEditType;
use App\Form\UserPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    #[Security("is_granted('ROLE_USER') and user === choosenUser ")]
    #[Route('/user/edit/{id}', name: 'user_edit')]
    public function edit(User $choosenUser, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher): Response
    {

       if (!$this->getUser()) {
           return $this->redirectToRoute('security_login');
        }

        if ($this->getUser() !== $choosenUser) {
            return $this->redirectToRoute("category_index");
       }


        $form = $this->createForm(UserEditType::class, $choosenUser);
        $form->handleRequest($request);
        if ($form->isSubmitted() &&  $form->isValid()) {
            if ($hasher->isPasswordValid($choosenUser, $form->getData()->getPlainPAssword())) {

                $choosenUser = $form->getData();
                $manager->persist($choosenUser);
                $manager->flush();

                $this->addFlash(
                    'success',
                    'Modification réussi.'
                );
                return $this->redirectToRoute('category_index');
            } else {
                $this->addFlash(
                    'warning',
                    'Le mot de passe est incorrect.'
                );
            }
        }
        return $this->render('user/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Security("is_granted('ROLE_USER')  and user === choosenUser ")]
    #[Route('/user/edit-password/{id}', 'user_edit_password', methods: ['GET', 'POST'])]
    public function editPassword(
        User $choosenUser,
        Request $request,
        EntityManagerInterface $manager,
        UserPasswordHasherInterface $hasher
    ): Response {



       if (!$this->getUser()) {
           return $this->redirectToRoute('security_login');
        }

       if ($this->getUser() !== $choosenUser) {
            return $this->redirectToRoute("category_index");
      }


        $form = $this->createForm(UserPasswordType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($hasher->isPasswordValid($choosenUser, $form->getData()['plainPassword'])) {
                $choosenUser->setUpdatedAt(new \DateTimeImmutable());
                $choosenUser->setPlainPassword(
                    $form->getdata()['newPassword']
                );

                $manager->persist($choosenUser);
                $manager->flush();

                $this->addFlash(
                    'success',
                    'Le mot de passe a été modifié'
                );
                return $this->redirectToRoute('category_index');
            } else {
                $this->addFlash(
                    'warning',
                    'Le mot de passe est  incorrect'
                );
            }
        }

        return $this->render('/user/edit_password.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Security("is_granted('ROLE_USER')")]
    #[Route('/user/info/', name: 'user_profil', methods: ['GET'])]
    public function info(): Response
    {


        return $this->render('user/info.html.twig', []);
    }
}