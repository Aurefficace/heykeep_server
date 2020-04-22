<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @Route("user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/profile", name="app_user_profile")
     */
    public function UserAction()
    {
        return $this->render('user/userProfile.html.twig');
    }

    /**
     * @Route("/resetPassword", name="app_user_reset_password", methods={"POST"})
     */
    public function resetPassword(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = $this->getUser();
        if ($user === null) {
            return $this->redirectToRoute('app_login');
        }

        $entityManager = $this->getDoctrine()->getManager();

        $password = $request->request->get("password");
        $passwordConfirmation = $request->request->get("passwordConfirmation");

        if($password !== $passwordConfirmation) {
            return new JsonResponse(['error' => "Les deux mots de passes doivent être identiques"]);
        }

        $encodedPassword = $passwordEncoder->encodepassword($user, $password);
        $user->setPassword($encodedPassword);
        try {
            $entityManager->persist($user);
            $entityManager->flush();
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e]);
        }
        return new JsonResponse( ['success' => "Votre mot de passe à été réinitialisé"]);
    }
}
