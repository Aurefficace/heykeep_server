<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class UserController extends AbstractController

{
    /**
     * @Route("/register", name="api_register", methods={"POST"})
     */
    public function register(UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $om, Request $request)
    {
        $user = new User();
        $email                  = $request->request->get("email");
        $password               = $request->request->get("password");
        $passwordConfirmation   = $request->request->get("password_confirmation");
        $name   = $request->request->get("name");
        $avatar = "src/test";
        $isactif = true;
        $role = [];

        $errors = [];
        if ($password != $passwordConfirmation) {
            $errors[] = "Les passwords sont différents";
        }
        if (strlen($password) < 8) {
            $errors = "Mots de passe trop court comme ta bite!";
        }

        if (!$errors) {
            $dateNow = new DateTime();
            $encodedPassword = $passwordEncoder->encodepassword($user, $password);
            $user->setEmail($email);
            $user->setRoles($role);
            $user->setPassword($encodedPassword);
            $user->setCreatedDate($dateNow);
            $user->setUpdatedDate($dateNow);
            $user->setName($name);
            $user->setAvatar($avatar);
            $user->setIsactif($isactif);

            try {
                $om->persist($user);
                $om->flush();

                return $this->json([
                    'user' => $user,
                ]);
            } catch (UniqueConstraintViolationException $e) {
                $errors[] = "L'e-mail fourni a déjà un compte!";
            } catch (\Exception $e) {
                $errors[] = "Impossible d'enregistrer un nouvel utilisateur pour le moment.";
            }
        }
        return $this->json([
            'errors' => $errors
        ], 400);
    }

    /**
     * @Route("/login", name="api_login", methods={"POST"})
     */
    public function login()
    {
        return $this->json(['result' => true]);
    }

    /**
     * @Route("/profile", name="api_profile")
     * @IsGranted("ROLE_USER")
     */
    public function profile()
    {
        return $this->json(
            [
                'user' => $this->getUser()
            ],
            200,
            [],
            [
                'groups' => ['api']
            ]
        );
    }

    /**
     * @Route("/", name="api_home")
     */
    public function home()
    {
        return $this->json(['result' => true]);
    }
}
