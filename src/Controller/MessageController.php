<?php

namespace App\Controller;

use App\Entity\Discussion;
use App\Entity\Message;
use App\Entity\User;
use App\Form\MessageType;
use App\Mercure\JwtProvider as MercureJwtProvider;
use App\Repository\MessageRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/message")
 */
class MessageController extends AbstractController
{
    /**
     * @Route("/", name="message_index", methods={"GET"})
     */
    public function index(MessageRepository $messageRepository, MercureJwtProvider $generator): Response
    {
        return $this->render('message/index.html.twig', [
            'messages' => $messageRepository->findAll(),
        ]);
       

    }

    /**
     * @Route("/new/", name="message_new", methods={"POST"})
     */
    public function new(Request $request, MessageBusInterface $messageBus): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $now = new DateTime();
        $user = $this->getUser();
        $newMessage = $request->get('message');
        $idDiscussion = $request->get('discussion');
        $discussion = $entityManager->getRepository(Discussion::class)->find($idDiscussion);
        $message = new Message();
        $message->setIdUser($user);
        $message->setContent($newMessage);
        $message->setCreatedDate($now);
        $message->setIdDiscussion($discussion);

        try {
           
            $target = [];
            foreach ($discussion->getIdUser() as $discussionUser)
                $target[] = "http://127.0.0.1/instantmessages/".$discussionUser->getId();
           
            $update = new Update('http://127.0.0.1/instantmessages/'.$discussionUser->getId(), json_encode(["data" => [
                'message' => $message->getContent(),
                'date' => $message->getCreatedDate(),
                'user' => ['id' => $user->getId(), 'avatar' => $user->getAvatar(), 'name' => $user->getName()]
                ]]), $target);
                
            $messageBus->dispatch($update);
    
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()]);
        }

        try {
            $entityManager->persist($message);
            $entityManager->flush();
        } catch (\Exception $e) {

            return new JsonResponse(['error' => $e->getMessage()]);
        }
        

        // return new JsonResponse(['success' => [
        //     'message' => $message->getContent(),
        //     'date' => $message->getCreatedDate(),
        //     'user' => ['id' => $user->getId(), 'avatar' => $user->getAvatar(), 'name' => $user->getName()]
        //     ]]);
        return new JsonResponse(['ok' => 'ok']);
    }

    /**
     * @Route("/{id}", name="message_show", methods={"GET"})
     */
    public function show(Message $message): Response
    {
        return $this->render('message/show.html.twig', [
            'message' => $message,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="message_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Message $message): Response
    {
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('message_index');
        }

        return $this->render('message/edit.html.twig', [
            'message' => $message,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="message_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Message $message): Response
    {
        if ($this->isCsrfTokenValid('delete' . $message->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($message);
            $entityManager->flush();
        }

        return $this->redirectToRoute('message_index');
    }
}
