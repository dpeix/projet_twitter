<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Conv;
use App\Entity\Message;
use App\Repository\ConvRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessagingController extends AbstractController
{
    #[Route('/messaging', name: 'messaging_index')]
    public function index(ConvRepository $convRep): Response
    {
        $user = $this->getUser();
        $convs = $convRep->findByUser($user);

        return $this->render('messaging/index.html.twig', [
            'convs' => $convs,
        ]);
    }

    #[Route('/messaging/{id}', name: 'messaging_conv')]
    public function conv(string $id, ConvRepository $convRep): Response
    {
        $conv = $convRep->find((int) $id);
        
        $conv = $convRep->findAll();

        $messages = $convRep->findAll();
            //->findBy(['conv' => $conv], ['datePost' => 'ASC']);

        return $this->render('messaging/conv.html.twig', [
            'conv' => $conv,
            'messages' => $messages,
        ]);
    }

    #[Route('/messaging/{id}/send', name: 'send_message', methods: ['POST'])]
    public function sendMessage(Request $request, Conv $conversation, ConvRepository $convRep): JsonResponse
    {
        $messageText = $request->request->get('text');
        $message = new Message();
        $message->setConv($conversation);
        $message->setAuthor($this->getUser()->getUsername());
        $message->setText($messageText);
        $message->setDatePost(new \DateTime());

        $em = $convRep->getRepository(Conv::class)->getManager();
        $em->persist($message);
        $em->flush();

        return new JsonResponse(['status' => 'success']);
    }

    #[Route('/messaging/create', name: 'messaging_create', methods: ['POST'])]
    public function createConversation(Request $request, EntityManagerInterface $em): RedirectResponse
    {
        // Récupérer l'utilisateur courant
        $user = $this->getUser();
        
        // Créer une nouvelle conversation
        $conv = new Conv();
        $conv->setDateLastMessage(new \DateTimeImmutable()); // Initialisation de la date du dernier message

        // Sauvegarder la conversation dans la base de données
        $em->persist($conv);
        $em->flush();

        // Ajouter l'utilisateur à la conversation
        $convUser = new ConvUser();
        $convUser->setUser($user);
        $convUser->setConv($conv);
        $convUser->setDateLastCheck(new \DateTimeImmutable()); // Date de la dernière vérification

        // Sauvegarder l'association dans la base de données
        $em->persist($convUser);
        $em->flush();

        // Rediriger vers la page de cette conversation
        return $this->redirectToRoute('messaging_conv', ['id' => $conv->getId()]);
    }

}

