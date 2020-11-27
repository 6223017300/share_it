<?php

namespace App\Database;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\FetchMode;

/**
 * Ce service est en charge de la gestion des données de la table 'fichiers'
 * Elle doit utiliser des objets de la classe Fichier
 */
class FichierManager{

    private $connection;

    /**
     * Les objets FichierManager pourront être demandés en argument dans les controlleurs
     * Pour les instancier, le conteneur de services va lire la liste d'arguments du constructeur
     * Ici, il va d'abord instancier le service Connection pour pouvoir instancier FichierManager
     */
    public function __construct(Connection $connection){

        $this->connection = $connection;
    }

    /**
     * Recuperer un fichier par son id
     * 
     * @param int $id l'identifiant en base du fichier
     * @return Fichier|null le fichier trouvé ou null en l'absence de resultat
     */

     public function getById(int $id): ?Fichier{

        $query = $this->connection->prepare('SELECT * FROM fichiers WHERE id = :id');
        $query->bindValue('id', $id);
        $query->execute();
        // tableau associative contenant les données du fichier, ou false si aucun resultats
        $fichierData = $query->fetch(FetchMode::ASSOCIATIVE);

        if($fichierData === false){
            return null;
        }

        return $this->createObjet($fichierData['id'],$fichierData['nom'], $fichierData['nom_original']);

        // Creation d'une instance de fichier
        $fichier = new Fichier();
        $fichier
                ->setId($fichierData['id'])
                ->setNom($fichierData['nom'])
                ->setNomOriginal($fichierData['nom_original'])
            ;
            return $fichier;    

     }

     public function createFichier(string $nom, string $nomOriginal): Fichier{
         // Enregistrer en base de données (voir HomeController:homepage())
         $this->connection->insert('fichiers', [
            'nom' => $nom,
            'nom_original' => $nomOriginal,
        ]);
         // Récuperer l'identifiant generer du fichier enregistrer
         $id = $this->connection->lastInsertId();

         // Creer un objet Fichier et le retourne: creer une methode creatObjet()

          
         return $this->createObjet($id, $nom, $nomOriginal);
        
       

     }

     private function createObjet(int $id, string $nom, string $nomOriginal){
        $fichier = new Fichier();
        $fichier
                ->setId($id)
                ->setNom($nom)
                ->setNomOriginal($nomOriginal)
            ;
            return $fichier;    
     }
     
       

    
   
    


}