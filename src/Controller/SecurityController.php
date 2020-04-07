<?php

namespace App\Controller;

use App\Entity\ForgottenPassword;
use App\Entity\User;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Bundle\SwiftmailerBundle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('dashboard');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    //    /**
    //     * @Route("/logout", name="app_logout")
    //     */
    //    public function logout()
    //    {
    ////        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    //    }


    /**
     * @Route("/forgottenPassword", name="app_forgottenPassword")
     */
    public function forgottenPassword(Request $request, \Swift_Mailer $mailer, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        if ($request->isMethod('POST')) {

            $email = $request->request->get('email');
            $entityManager = $this->getDoctrine()->getManager();

            $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

            if ($user === null) {
                return $this->redirectToRoute('app_login');
            }

            $lien = md5(sha1(microtime()));
            $forgottenPassword = new ForgottenPassword();
            
            
            $forgottenPassword->setIdUser($user);
            $forgottenPassword->setToken($lien);
            $forgottenPassword->setCreatedDate(new DateTime());
            try {

                $entityManager->persist($forgottenPassword);
                $entityManager->flush();
            } catch (\Exception $e) {
                return $e;
            }


            $token = $entityManager->getRepository(ForgottenPassword::class)->findOneBy(['IdUser' => $user->getId()]);
            dump($token);
            exit();

            $message = (new \Swift_Message('Mot de Passe oublié'))
                ->setFrom('heykeep@heykeep.com')
                ->setTo($user->getEmail())
                ->setBody(
                    "Tiens ton mot de passe: " . $user->getPassword(),
                    'text/html'
                );
            // $mailer->send($message)
            dump($message);
            exit();
            return $this->redirectToRoute('app_login');
        }
        return $this->render('security/forgottenPassword.html.twig');
    }
}
