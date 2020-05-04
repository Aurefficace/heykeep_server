<?php

namespace App\Controller;

use App\Entity\Discussion;
use App\Form\DiscussionType;
use App\Form\MessageType;
use App\Repository\DiscussionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/discussion")
 */
class DiscussionController extends BaseController
{
    /**
     * @Route("/", name="discussion_index", methods={"GET"})
     */
    public function index(DiscussionRepository $discussionRepository): Response
    {
        $userId = $this->getUser()->getId();

        return $this->render('discussion/index.html.twig', [
            'discussions' => $discussionRepository->findByUserId($userId),
        ]);
    }

    /**
     * @Route("/new", name="discussion_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user = $this->getUser();
        $userId = $user->getId();
        $discussion = new Discussion();
        $form = $this->createForm(DiscussionType::class, $discussion, ['attr' => ['idUser' => $userId]]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $discussion->addIdUser($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($discussion);
            $entityManager->flush();

            return new JsonResponse(['success' => 'Votre conversation à bien été ajouté']);
        }
        elseif($form->isSubmitted() ){
            return $this->neweditSubmittedGlobal($form);
        }
        
        return $this->render('discussion/new.html.twig', [
            'discussion' => $discussion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="discussion_show")
     */
    public function show(Discussion $discussion, Request $request): Response
    {
         $messages = $discussion->getMessages();
         $userId =$this->getUser()->getId();
        return $this->render('discussion/show.html.twig', [
            'discussion' => $discussion,
            'messages' => $messages,
            'userId' => $userId
        ]);
    }

    /**
     * @Route("/{id}/edit", name="discussion_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Discussion $discussion): Response
    {
        $form = $this->createForm(DiscussionType::class, $discussion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('discussion_index');
        }

        return $this->render('discussion/edit.html.twig', [
            'discussion' => $discussion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="discussion_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Discussion $discussion): Response
    {
        if ($this->isCsrfTokenValid('delete' . $discussion->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($discussion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('discussion_index');
    }
}
