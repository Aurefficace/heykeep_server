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
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
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
    public function forgottenPassword(Request $request, \Swift_Mailer $mailer): Response
    {
        if ($request->isMethod('POST')) {

            $email = $request->request->get('email');
            $entityManager = $this->getDoctrine()->getManager();

            $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);


            if ($user == null) {
                return $this->render('security/forgottenPassword.html.twig', ['errorUser'=> $email]);
            }

            $token = md5(sha1(microtime()));
            $forgottenPassword = new ForgottenPassword();


            $forgottenPassword->setIdUser($user);
            $forgottenPassword->setToken($token);
            $forgottenPassword->setCreatedDate(new DateTime());
            try {

                $entityManager->persist($forgottenPassword);
                $entityManager->flush();
            } catch (\Exception $e) {
                return $e;
            }


            $url = $this->generateUrl('app_reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);
            $message = (new \Swift_Message('Mot de Passe oublié'))
                ->setFrom('heykeep@heykeep.com')
                ->setTo($user->getEmail())
                ->setBody(
                     $url,
                    'text/html'
                );
            // $mailer->send($message)
            // dump($message->getBody());
            // exit();
            return new JsonResponse(['success' => $message->getBody()]);
        }
        return $this->render('security/forgottenPassword.html.twig');
    }

    /**
     * @Route("/resetPassword", name="app_reset_password")
     */
    public function resetPassword(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $token = $request->get('token');
        $entityManager = $this->getDoctrine()->getManager();
        $forgottenPassword = $entityManager->getRepository(ForgottenPassword::class)->findOneBy(['token' => $token]);
        $now = new DateTime();
        $interval = (date_diff($forgottenPassword->getCreatedDate(), $now));
     

        if ($interval->days >= 1) {
            return $this->render('security/resetPassword.html.twig', ['linkValidity' => "Le lien n'est plus valide"]);
        }

        if ($request->isMethod('POST')) {

            $password = $request->request->get("password");

            $user = $entityManager->getRepository(User::class)->findOneBy(['id' => $forgottenPassword->getIdUser()]);

            if ($user === null) {
                return $this->redirectToRoute('app_login');
            }
            
            $encodedPassword = $passwordEncoder->encodepassword($user, $password);
            $user->setPassword($encodedPassword);
            try {
                $entityManager->persist($user);
                $entityManager->flush();
            } catch (\Exception $e) {
                
                return new JsonResponse(['error' => $e]);
            }
            return new JsonResponse( ['success' => "Votre mot de passe à été réinitialisé, vous allez être redirigé"]);
        }
        
        return $this->render('security/resetPassword.html.twig');
    }
}
