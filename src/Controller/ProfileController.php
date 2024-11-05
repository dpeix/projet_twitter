<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Tweet;
use App\Repository\TweetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'profile')]
    public function index(TweetRepository $tweetRepository): Response
    {
        // Récupérer les informations de l'utilisateur (ex. depuis la base de données)
        $user = $this->getUser();

        // Récupérer les tweets récents de l'utilisateur
        $tweets = $tweetRepository->findBy(['user' => $user], ['createdAt' => 'DESC']);

        // Vérification si l'utilisateur existe
        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }

        return $this->render('profile/index.html.twig', [
            'user' => $user,
            'tweets' => $tweets,
            'controller_name' => 'ProfileController',
        ]);
    }
}
