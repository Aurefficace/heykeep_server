<?php

namespace App\Controller;

use App\Entity\Discussion;
use App\Entity\Space;
use App\Form\DiscussionType;
use App\Repository\DiscussionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/discussion")
 */
class DiscussionController_old extends BaseController
{
    /**
     * @Route("/", name="discussion_index", methods={"GET"})
     */
    public function index(DiscussionRepository $discussionRepository): Response
    {

        return new Response(['discussion' => $discussionRepository->findAll()]);
    }

    /**
     * @Route("/new", name="discussion_new", methods={"GET","POST"})
     */
    public function new(Request $request, Space $space): Response
    {
        $discussion = new Discussion();
        $form = $this->createForm(DiscussionType::class, $discussion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $discussion->setName($request);
            $discussion->setIdSpace($space);
            $discussion->setIspublic(true);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($discussion);
            $entityManager->flush();

            return $this->redirectToRoute('discussion_index');
        } elseif ($form->isSubmitted() && !$form->isValid()) {
            return $this->neweditSubmittedGlobal($form);
        }

        return $this->render('space/new.html.twig', [
            'discussion' => $discussion,
            'form' => $form->createView(),
        ]);
    }
}
