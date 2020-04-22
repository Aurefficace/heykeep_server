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

    /**
     * @Route("/resetAvat", name="app_User_reset_avatar", methods={"POST"})
     */
    public function resetAvatar(Request $request){

    $user = $this->getUser();
    $file = $request->files->get('avatar'); // Récupération du fichier pour l'avatar
    $user->setAvatar("avatar.".$file->guessExtension()); // Affectation d'un nom standard au fichier d'avatar

    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($user);
    $entityManager->flush();

    $filePath = $this->getParameter('kernel.project_dir').'/public/user/profile/'.$user->getId();
    Utilities::uploadFile($filePath, $file, "avatar.");
    
    //$targetDirectory = $this->getParameter('kernel.project_dir').'/public/user/profile/'.$user->getId(); // Création du chemin vers le futur lieu de stockage de l'avatar
    //if(!is_dir($targetDirectory)) { // On test si le dossier existe déjà (ici c'est impossible car on utilise l'id du nouvel utilisateur)
       // mkdir($targetDirectory); // On créé le dossier
       // chmod($targetDirectory, 0777); //On met des droits en lecture, modification et exécution pour tous le monde => pas bien !!!
    }
   $file->move($targetDirectory, "avatar.".$file->guessExtension()); // On envoie le fichier sur le serveur
    // Tindin !
    return new JsonResponse( ['success' => "Votre avatar est changé"]);
}
}


