<?php

namespace App\Helpers;

use Symfony\Component\HttpFoundation\File\File;

class Utilities
{
   static function uploadFile($path, File $file)
    {
        $targetDirectory = $path; // Création du chemin vers le futur lieu de stockage de l'espace
        if (!is_dir($targetDirectory)) { // On test si le dossier existe déjà (ici c'est impossible car on utilise l'id du nouvel espace)
            mkdir($targetDirectory); // On créé le dossier
            chmod($targetDirectory, 0777); //On met des droits en lecture, modification et exécution pour tous le monde => pas bien du tout !!!
        }
        $file->move($targetDirectory, "spaceimage." . $file->guessExtension()); // On envoie le fichier sur le serveur

    }
}