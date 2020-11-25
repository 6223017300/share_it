<?php

namespace App\Controller;

use App\File\UploadService;
use Doctrine\DBAL\Connection;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadedFileInterface;
use Twig\Template;

class HomeController extends AbstractController
{
    public function homepage(ResponseInterface $response, ServerRequestInterface $request, UploadService $uploadService, Connection $connection)
    {
        $database = $connection->getDatabase();
        
        // recupere les fichiers envoyer
        
        var_dump($_FILES);
        var_dump($request->getUploadedFiles());

        // Récupérer les fichiers envoyés:
        $listeFichiers = $request->getUploadedFiles(); 

        // Récupérer les fichiers envoyés:
        $listeFichiers = $request->getUploadedFiles();

        // Si le formulaire est envoyé
        if (isset($listeFichiers['fichier'])) {
            /** @var UploadedFileInterface $fichier */
            $fichier = $listeFichiers['fichier'];

            // recuperer le nouveau nom du fichier
            $nouveauNom = $uploadService->saveFile($fichier);

            // Enregistrer les infos du fichier en base de données

           
            $connection->insert('fichiers', [
                'nom' => $nouveauNom,
                'nom_original' => $fichier->getClientFilename(),
            ]);

            /*// méthode executeStatement()
            $connection->executeStatement('INSERT INTO fichier (nom, nom_original) VALUES (:nom, :nom_original)', [
                'nom' => $nouveauNom,
                'nom_original' => $fichier->getClientFilename(),
            ]);

            // méthode prepare() (style PDO)
            $query = $connection->prepare('INSERT INTO fichier (nom, nom_original) VALUES (:nom, :nom_original)');
            $query->bindValue('nom', $nouveauNom);
            $query->bindValue('nom_original', $fichier->getClientFilename());
            $query->execute();

            // Query Builder
            $queryBuilder = $connection->createQueryBuilder();
            $queryBuilder
                ->insert('fichier')
                ->values([
                    'nom' => $nouveauNom,
                    'nom_original' => $fichier->getClientFilename(),
                ])
                ;
            $queryBuilder->execute();*/
    
            
    // on recuper l'id tjrs dans un tableau
    
    
    
            

           //  Afficher un message à l'utilisateur

            //Generer un nom de fichier unique:
            //horodatage + chaine de caractere aleatoire + extension
            
            
            /*$filename = date('YmdHis');
            $filename .= bin2hex(random_bytes(8));
            $filename .= '.' .pathinfo($fichier->getClientFilename(), PATHINFO_EXTENSION);

            //construire le chemin de destination du fichier:
            //chemin vers le dossier / files/ + noveau nom de fichier

            $path = __DIR__ .'/../../files/' .$filename;

            // Deplacer le fichier

            $fichier->moveTo($path);*/

            /**
             * Méthodes à utiliser de $fichier:
             *      getClientFilename()     nom original du fichier
             *      getError()              code d'erreur
             *      moveTo()                déplacer le fichier
             * 
             */

            
            
        }

        

        return $this->template($response, 'home.html.twig' );
            //'database_name' => $database,
            //'users' => ['Pierre', 'Paul', 'Jacque'],
            //'xss' => '<script> window.alert ("Coucou"); </script>'

       
    }

   /* public function test(){

        return $this->redirect('about');
    }

    public function about(ResponseInterface $response){

        $response->getBody()->write('<h1> A propos de nous </h1>');
        return $response;
    }*/

    

    public function download(ResponseInterface $response, int $id){
        $response->getBody()->write(sprintf('Identifiant: %d', $id));
        return $response;
    }

    
}
