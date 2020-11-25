<?php

Namespace App\File;

use Psr\Http\Message\UploadedFileInterface;

/**
 * Service en charge de l'enregistrement de fichiers
 */

 class UploadService{

    public const FILE_DIR = __DIR__ .'/../../files';
     /**
      * Enregistrer un fichier
      * @param UploadedFileInterface $file le fichier chargé à enregister 
      * @return string|null le nouveau nom du fichier
      */




      public function saveFile(UploadedFileInterface $file): string{

            
            //construire le chemin de destination du fichier:
            //chemin vers le dossier / files/ + noveau nom de fichier
            $filename = $this->generateFilename($file);

            $path = self::FILE_DIR . '/' .$filename;


            // Deplacer le fichier

            $file->moveTo($path);
            return $filename;


      }

      /**
       * Génerer un nom de fichier aléatoire et unique
       * 
       * @param UploadFileInterface $file le fichier à enregistrer
       * @return string le nom unique generé
       */
      private function generateFilename(UploadedFileInterface $file): string{

        /**
         * Ecrire le code de generateFilename()
         * Utiliser la methode generateFilename() dans la methode saveFile()
         * Ajouter un argument UploadService dans le HomeController et utilise
         */

         //Generer un nom de fichier unique:
        //horodatage + chaine de caractere aleatoire + extension

            $filename = date('YmdHis');
            $filename .= bin2hex(random_bytes(8));
            $filename .= '.' .pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);

            return $filename;
 




      }
 }