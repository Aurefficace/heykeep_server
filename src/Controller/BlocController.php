<?php

namespace App\Controller;

use App\Entity\Bloc;
use App\Form\BlocType;
use App\Repository\BlocRepository;
use App\Entity\Element;
use App\Helpers\Utilities;
use App\Repository\ElementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bloc")
 */
class BlocController extends AbstractController
{
    /**
     * @Route("/", name="bloc_index", methods={"GET"})
     */
    public function index(BlocRepository $blocRepository): Response
    {
        $user = $this->getUser();

        return $this->render('bloc/index.html.twig', [
            'blocs' => $blocRepository->findBlocByIdOwner($user->getId()),
        ]);
    }

    /**
     * @Route("/new", name="bloc_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user = $this->getUser();
        $bloc = new Bloc();
        $form = $this->createForm(BlocType::class, $bloc, ['attr' => ['user' => $user]]);
        $form->handleRequest($request);

        
        if ($form->isSubmitted() && $form->isValid()) {
            $bloc->setCreatedDate(new \DateTime('today'));
            $bloc->setIsarchiv(0);
            $bloc->setIdOwner($this->getUser());
            $type = $bloc->getElement()->getType();
          
           $contentElement = $request->get('contentElement');
           switch ($type) {
            case '0':
               $bloc->getElement()->setContent($contentElement);
                break;
            case '1':
                $contentElement = $request->files->get('contentElement');
                dump($contentElement,'fonctionnalité à venir');
                exit();
                $bloc->getElement()->setContent("element.".$contentElement->guessExtension());
                $filePath = $this->getParameter('kernel.project_dir').'/public/user/element/'.$user->getId();
                Utilities::uploadFile($filePath, $contentElement, "element.");
                break;
            case '2':
                $bloc->getElement()->setContent($contentElement);
                break;
        }
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bloc);
            $entityManager->flush();

            return $this->redirectToRoute('bloc_index');
        }

        return $this->render('bloc/new.html.twig', [
            'bloc' => $bloc,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bloc_show", methods={"GET"})
     */
    public function show(Bloc $bloc): Response
    {
        return $this->render('bloc/show.html.twig', [
            'bloc' => $bloc,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bloc_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Bloc $bloc): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(BlocType::class, $bloc, ['attr' => ['user' => $user]]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bloc_index');
        }

        return $this->render('bloc/edit.html.twig', [
            'bloc' => $bloc,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bloc_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Bloc $bloc): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bloc->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bloc);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bloc_index');
    }
}
