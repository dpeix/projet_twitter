<?php

namespace App\Controller;

use APP\Entity\User;
use App\Entity\Tweet;
use App\Form\TweetType;
use App\Repository\TweetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TweeterController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(TweetRepository $tweetRepository, Request $request, EntityManagerInterface $em): Response
    {
        // Créer une instance de Tweet
        $tweet = new Tweet();

        // Créer un formulaire
        $form = $this->createForm(TweetType::class, $tweet);
        $form->handleRequest($request);

        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            $tweet->setCreatedAt(new \DateTimeImmutable()); // Définir la date de création automatiquement

            // Si tu as un système d'utilisateur connecté, tu peux récupérer l'username depuis l'utilisateur connecté
            $user = $this->getUser();
            if ($user) { 
                $tweet->setUser($user);
            }

            // Définir les valeurs du tweet par défaut
            $tweet->setState(true);
            $tweet->setLikes(0);
            $tweet->setRetweets(0);
            // Sauvegarder le tweet dans la base de données
            $em->persist($tweet);
            $em->flush();

            // Rediriger vers la page d'accueil après soumission
            return $this->redirectToRoute('home');
        }

        // Récupérer tous les tweets de la base
        $tweets = $tweetRepository->findAll();

        // Rendre la vue avec les tweets et le formulaire
        return $this->render('tweeter/index.html.twig', [
            'tweets' => $tweets,
            'form' => $form->createView(),
        ]);
    }
}
