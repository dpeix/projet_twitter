<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager
    ): Response {
        // Création d'un nouvel utilisateur
        $user = new User();

        // Création du formulaire d'inscription
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        // Validation et traitement du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            // Hashage du mot de passe
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $form->get('plainPassword')->getData()
            );
            $user->setPassword($hashedPassword);

            dump($form->get('birthday')->getData());
            dump($user->getBirthday());
            exit();

            // Ajouter le rôle par défaut
            $user->setRoles(['ROLE_USER']);

            // Sauvegarde de l'utilisateur en base de données
            $entityManager->persist($user);
            $entityManager->flush();

            // Redirection après inscription
            return $this->redirectToRoute('app_home');
        }

        // Rendu de la page d'inscription
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
