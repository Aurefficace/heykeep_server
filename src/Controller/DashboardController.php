<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Repository\SpaceRepository;

class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     */
    public function dashboardAction(SpaceRepository $spaceRepository) : Response
    {
        return $this->render('dashboard.html.twig',
            [
                'spaces' => $spaceRepository->findAll(),

            ]);
    }
}
