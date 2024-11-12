<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Conv;
use App\Entity\ConvUser;
use App\Entity\Message;
use App\Repository\ConvRepository;
use App\Repository\UserRepository;
use App\Form\ConvType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
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

    #[Route('/messaging/{id}', name: 'messaging_conv', requirements: ['id' => '\d+'])]
    public function conv(string $id, ConvRepository $convRep): Response
    {
        $conv = $convRep->find($id);

        if (!$conv) {
            throw $this->createNotFoundException('Conversation not found');
        }

        $messages = $conv->getMessages(); // Assuming getMessages() fetches associated messages

        return $this->render('messaging/conv.html.twig', [
            'conv' => $conv,
            'messages' => $messages,
        ]);
    }

    #[Route('/messaging/{id}/send', name: 'send_message', methods: ['POST'])]
    public function sendMessage(int $id, Request $request, ConvRepository $convRep, EntityManagerInterface $em, Conv $conv): Response
    {
        $conversation = $convRep->find($id);

        $messageText = $request->request->get('text');
        // Création du message
        $message = new Message();
        $message->setConv($conversation);
        $message->setAuthor($this->getUser()->getUsername());
        $message->setText($messageText);
        $message->setDatePost(new \DateTime());
        
        $conv->setDateLastMessage(new \DateTimeImmutable());

        // Persister le message
        $em->persist($message);
        $em->flush();

        // Rediriger vers la page de la conversation avec un message de succès
        $this->addFlash('success', 'Message sent successfully');
        return $this->redirectToRoute('messaging_conv', ['id' => $id]);
    }


    #[Route('/messaging/new', name: 'messaging_new')]
    public function new(Request $request, EntityManagerInterface $em, UserRepository $userRepo): Response
    {
        $conv = new Conv();

        $form = $this->createForm(ConvType::class, $conv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $currentUser = $this->getUser();
            $selectedUser = $form->get('convUsers')->getData(); // Obtenez les utilisateurs sélectionnés

            $conv->setDateLastMessage(new \DateTimeImmutable());
            $em->persist($conv); // Persist la conversation
            $em->flush();

            // Persist des relations entre les utilisateurs et la conversation
            foreach ( $selectedUser as $user) {
                $convUser = new ConvUser();
                $convUser->setUsers($user);
                $convUser->setConvs($conv);
                $convUser->setDateLastCheck(new \DateTimeImmutable());

                $em->persist($convUser);
                $em->flush();
                $conv->addConvUser($convUser);
                $em->flush();
            }
            //$em->flush();

            return $this->redirectToRoute('messaging_conv', ['id' => $conv->getId()]);
        }

        return $this->render('messaging/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
