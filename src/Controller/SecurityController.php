<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Address as E_address;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'security_login', methods: ['POST', 'GET'])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('/security/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError()
        ]);
    }
    #[Route('/logout', name: 'security_logout')]
    public function logout()
    {
        //Nothing to do here
    }
    #[Route('/registration', name: 'security_registration', methods: ['GET', 'POST'])]
    public function registration(EntityManagerInterface $manager, Request $request, MailerInterface $mailer): Response
    {
        $user = new User();
        $user->setRoles(['ROLE_USER']);
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

               
     

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();


            $email = (new TemplatedEmail())
            ->from(new E_address('quentin.derycke6@gmail.com', 'Green MailBot'))
            ->to($user->getEmail())
            ->cc('qderycke10@gmail.com')
            ->subject('Compte bien créé')
            ->htmlTemplate('mail/email_verif.html.twig')
            ->context([
                'user' => $user,
            ]);


    $mailer->send($email); 
    

            $this->addFlash(
                'success',
                'Votre compte a bien été créé'
            );
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute(('security_login'));
        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
