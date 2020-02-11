<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/register", name="api_register", methods={"POST"})
     */
    public function register( UserPasswordEncoderInterface $passwordEncoder, Request $request)
    {
        $user = new User();
        $email                  = $request->request->get("email");
        $password               = $request->request->get("password");
        $passwordConfirmation   = $request->request->get("password_confirmation");

        $errors = [];
        if ($password != $passwordConfirmation) {
            $errors[] = "Les passwords sont différents";
        }
        if (strlen($password) < 8) {
            $errors = "Mots de passe trop court comme ta bite!";
        }

        if (!$errors) {
            $encodedPassword = $passwordEncoder->encodepassword($user, $password);
            $user->setEmail($email);
            $user->setPassword($encodedPassword);

            

            return $this->json([
                'user' => $user,
            ]);
        }
        return $this->json([
            'errors' => $errors
        ], 400);
    }
}
