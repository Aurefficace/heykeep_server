<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Element;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class ElementController extends AbstractController
{
    /**
     * @Route("/addelement", name="api_addelement", methods={"POST"})
     */
    public function register(EntityManagerInterface $om, Request $request)
    {
        $element = new Element();
        $content = $request->request->get("content");
        $type = $request->request->get("type");

        $errors = [];

        if (!$errors) {
            $element->setContent($content);
            $element->setType($type);

            try {
                $om->persist($element);
                $om->flush();

                return $this->json([
                    'element' => $element,
                ]);
            }

            catch (\Exception $e) {
                $errors[] = "Impossible d'enregistrer un nouveau controlleur pour le moment.";
            }
        }
        return $this->json([
            'errors' => $errors
        ], 400);

    }

    /**
     * @Route("/element", name="element")
     */
    public function index()
    {
        return $this->render('element/index.html.twig', [
            'controller_name' => 'ElementController',
        ]);
    }
}
