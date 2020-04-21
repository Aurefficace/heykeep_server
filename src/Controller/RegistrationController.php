<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\AppAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use DateTime;

class RegistrationController extends BaseController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, AppAuthenticator $authenticator): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $role = [];
            $dateNow = new DateTime();
            $isActif = true;
            $user->setRoles($role);
            $user->setCreatedDate($dateNow);
            $user->setIsactif($isActif);

            $file = $form['avatar']->getData(); // Récupération du fichier pour l'avatar
            $user->setAvatar("avatar.".$file->guessExtension()); // Affectation d'un nom standard au fichier d'avatar

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $targetDirectory = $this->getParameter('kernel.project_dir').'/public/user/profile/'.$user->getId(); // Création du chemin vers le futur lieu de stockage de l'avatar
            if(!is_dir($targetDirectory)) { // On test si le dossier existe déjà (ici c'est impossible car on utilise l'id du nouvel utilisateur)
                mkdir($targetDirectory); // On créé le dossier
                chmod($targetDirectory, 0777); //On met des droits en lecture, modification et exécution pour tous le monde => pas bien !!!
            }
            $file->move($targetDirectory, "avatar.".$file->guessExtension()); // On envoie le fichier sur le serveur
            // Tindin !

            // do anything else you need here, like send an email
            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        } elseif ($form->isSubmitted() && !$form->isValid()) {
            return $this->neweditSubmittedGlobal($form);
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
