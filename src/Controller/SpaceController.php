<?php

namespace App\Controller;

use App\Entity\Space;
use App\Form\SpaceType;
use App\Repository\SpaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/space")
 */
class SpaceController extends BaseController
{
    /**
     * @Route("/", name="space_index", methods={"GET"})
     */
    public function index(SpaceRepository $spaceRepository): Response
    {

        return $this->render('space/index.html.twig', [
            'spaces' => $spaceRepository->findAll(),

        ]);
    }

    /**
     * @Route("/new", name="space_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $space = new Space();
        $form = $this->createForm(SpaceType::class, $space);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $space->setCreatedDate(new \DateTime('today'));
            $space->setActif(true);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($space);
            $entityManager->flush();

            return $this->redirectToRoute('space_index');
        }
        elseif ($form->isSubmitted() && !$form->isValid()) {
            return $this->neweditSubmittedGlobal($form);
        }

        return $this->render('space/new.html.twig', [
            'space' => $space,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="space_show", methods={"GET"})
     */
    public function show(Space $space): Response
    {
        return $this->render('space/show.html.twig', [
            'space' => $space,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="space_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Space $space): Response
    {
        $form = $this->createForm(SpaceType::class, $space);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('space_index');
        }

        return $this->render('space/edit.html.twig', [
            'space' => $space,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="space_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Space $space): Response
    {
        if ($this->isCsrfTokenValid('delete'.$space->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($space);
            $entityManager->flush();
        }

        return $this->redirectToRoute('space_index');
    }
}
