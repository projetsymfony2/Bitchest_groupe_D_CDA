<?php

namespace App\Controller;

use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'security.login', methods: ['GET', 'POST'])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('pages/security/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUserName(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
        ]);
    }
    #[Route('/logout', name: 'security.logout')]
    public function logout()
    {
        // Pas de logique specifique ici car symfony s'occupe de ça
    }
    #[Route('/register', name: 'security.register', methods: ['GET', 'POST'])]
    public function register(Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher): Response
    {
        $user = new User();
        $user->setRoles(['ROLE_USER']);
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $hashedPassword = $hasher->hashPassword($user, $user->getPlainPassword());
            $user->setPassword($hashedPassword);
        
            // Ne stockez pas plainPassword en clair
            $user->setPlainPassword(""); 
        
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('security.login');
        }

        return $this->render('pages/security/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
