<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;

class BaseController extends AbstractController
{
    protected function neweditSubmittedGlobal(Form $form){
        $errors = array();
        if(count($form->getErrors()) > 0){
            $errors['formulaire'] = "";
            foreach ($form->getErrors() as $error) {
                $message = $error->getMessage();
                if(strpos($message, "CSRF")){
                    $message = htmlentities("Délai d'attente dépassé, la page n'est plus valide. Veuillez recharger la page puis réessayer.");
                }
                $errors['formulaire'] .= $message;
            }
        }
        foreach ($form->getIterator() as $key => $child)
        {
            if($child instanceof Form)
            {
                foreach ($child->getErrors() as $error) {
                    $errors[$key] = $error->getMessage();
                }
                foreach($child->getIterator() as $k => $c){
                    if($c instanceof Form)
                    {
                        foreach ($c->getErrors() as $error) {
                            $errors[$key] = $error->getMessage();
                        }
                        foreach($c->getIterator() as $k2 => $c2){
                            if($c2 instanceof Form)
                            {
                                foreach ($c2->getErrors() as $error) {
                                    $errors[$k2] = $error->getMessage();
                                }
                            }
                        }
                    }
                }
            }
        }
        return new JsonResponse(array(
                'success' => "",
                'error' => json_encode($errors)
            )
        );
    }
}