<?php

namespace App\Controller;

use App\Entity\Space;
use App\Form\SpaceType;
use App\Helpers\Utilities;
use App\Repository\SpaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        $user = $this->getUser();

        return $this->render('space/index.html.twig', [
            'spacesOwner' => $spaceRepository->findSpaceByIdOwner($user->getId()),
            'spacesMember' => $user->getSpacesMemberNotOwner(),
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
            $space->setLevel(0);
            $space->setIdOwner($this->getUser());
            $space->addIdMember($this->getUser());
            if ($form['imagefile']->getData()) {
                $file = $form['imagefile']->getData(); // Récupération du fichier pour l'image de l'espace
                $space->setImage("spaceimage." . $file->guessExtension()); // Affectation d'un nom standard au fichier d'image de l'espace
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($space);
            $entityManager->flush();

            if ($form['imagefile']->getData()) {
                Utilities::uploadFile($this->getParameter('kernel.project_dir') . '/public/space/' . $space->getId(), $file,"spaceimage.");
            }

            return $this->redirectToRoute('space_index');
        } elseif ($form->isSubmitted() && !$form->isValid()) {
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
            if ($form['imagefile']->getData()) {
                $file = $form['imagefile']->getData(); // Récupération du fichier pour l'image de l'espace
                $space->setImage("spaceimage." . $file->guessExtension()); // Affectation d'un nom standard au fichier d'image de l'espace
            }
            $this->getDoctrine()->getManager()->flush();
            if ($form['imagefile']->getData()) {
                Utilities::uploadFile($this->getParameter('kernel.project_dir') . '/public/space/' . $space->getId(), $file,"spaceimage.");
            }

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
        if ($this->isCsrfTokenValid('delete' . $space->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($space);
            $entityManager->flush();
        }

        return $this->redirectToRoute('space_index');
    }

    /**
     * @Route("/usersBySpace", name="users_by_space")
     */
    public function getUsersBySpace(Request $request, SpaceRepository $spaceRepository): Response
    {
        $id_space =  $request->get('id');
        $space = $spaceRepository->find($id_space);
        if ($space == null) {
            return new JsonResponse(['error' => "aucun espace trouvé"]);;
        }
        $users = [];
        foreach ($space->getIdMember() as $member) {
            $users[$member->getId()] = $member->getName();
        }
        return new JsonResponse(['success' => $users]);
    }
}
