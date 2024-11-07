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
    public function conv(int $id, ConvRepository $convRep): Response
    {
        $conv = $convRep->getRepository(Conv::class)
            ->find($id);

        $messages = $convRep->getRepository(Conv::class)
            ->findBy(['conv' => $conv], ['datePost' => 'ASC']);

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

}

