<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SpaceCreationController extends AbstractController
{
    /**
     * @Route("/spacecreation", name="spacecreation")
     */
    public function spaceCreationAction()
    {
        return $this->render('spaceCreation/spaceCreation.html.twig');
    }
}
