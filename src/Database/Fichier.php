<?php

namespace App\Database;

/**
 * Les objet de la classe fichier represente les données de la table 'fichiers'
 * 1 instance = 1 ligne
 */
class fichier{

      /*
     * PHP 7.4 et +
     *      private ?int $id = null;
     * PHP < 7.4:
     *      private $id;
     */
    private $id;
    private $nom; 
    private $nom_original = null; 

    public function getId(): ?int {
        return $this->id;
    }

    /**
     * self designe la class actuelle
     * @return self retourne l'objet actuel
     */
    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    public function getNom():?string{
        return $this->nom;

    }

    public function setNom(string $nom): self{
        $this->nom = $nom;
        return $this;
    }

    public function getNomOriginal(): ?string{
        return $this->nom_original;
    }

    public function setNomOriginal(string $nom_original){
        $this->nom_original = $nom_original;
        return $this;
    }
}