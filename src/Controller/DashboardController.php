<?php

namespace App\Controller;

use App\Entity\Space;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Repository\SpaceRepository;
use App\Mercure\JwtProvider as MercureJwtProvider;

class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     */
    public function dashboardAction(MercureJwtProvider $generator)
    {
        $em = $this->getDoctrine()->getManager();
        //$lastsActivities = $em->getRepository(User::class)->getLastsActivities($this->getUser());
        $user=$this->getUser();
        $response = $this->render('dashboard.html.twig',
            [
                'spacesOwned' => $em->getRepository(Space::class)->findBy(array("id_owner" => $user)),
                'spacesMember' => $user->getSpacesMemberNotOwner()
            ]);
            $response->headers->set('set-cookie', $generator->generate($this->getUser()));
            return $response;
    }
}
