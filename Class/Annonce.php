<?php

class Annonce {
    protected int $id;
    protected int $prix_depart;
    protected string $date_fin;
    protected string $voiture_modele;
    protected string $voiture_marque;
    protected int $voiture_puissance;
    protected int $voiture_annee;
    protected string $voiture_couleur;
    protected string $voiture_description;

    public function __construct(
        int $prix_depart,
        string $date_fin,
        string $voiture_modele, 
        string $voiture_marque,
        int $voiture_puissance,
        int $voiture_annee,
        string $voiture_couleur,
        string $voiture_description)
    {
      $this->setPrixDepart($prix_depart);
      $this->setDateFin($date_fin);
      $this->setVoitureModele ($voiture_modele);
      $this->setVoitureMarque ($voiture_marque);
      $this->setVoiturePuissance($voiture_puissance);
      $this->setVoitureAnnee($voiture_annee);
      $this->setVoitureCouleur($voiture_couleur);
      $this->setVoitureDescription($voiture_description);


    }

    

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of prix_depart
     */
    public function getPrixDepart(): int
    {
        return $this->prix_depart;
    }

    /**
     * Set the value of prix_depart
     */
    public function setPrixDepart(int $prix_depart): self
    {
        $this->prix_depart = $prix_depart;

        return $this;
    }

    /**
     * Get the value of date_fin
     */
    public function getDateFin(): string
    {
        return $this->date_fin;
    }

    /**
     * Set the value of date_fin
     */
    public function setDateFin(string $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    /**
     * Get the value of voiture_modele
     */
    public function getVoitureModele(): string
    {
        return $this->voiture_modele;
    }

    /**
     * Set the value of voiture_modele
     */
    public function setVoitureModele(string $voiture_modele): self
    {
        $this->voiture_modele = $voiture_modele;

        return $this;
    }

    /**
     * Get the value of voiture_marque
     */
    public function getVoitureMarque(): string
    {
        return $this->voiture_marque;
    }

    /**
     * Set the value of voiture_marque
     */
    public function setVoitureMarque(string $voiture_marque): self
    {
        $this->voiture_marque = $voiture_marque;

        return $this;
    }

    /**
     * Get the value of voiture_puissance
     */
    public function getVoiturePuissance(): int
    {
        return $this->voiture_puissance;
    }

    /**
     * Set the value of voiture_puissance
     */
    public function setVoiturePuissance(int $voiture_puissance): self
    {
        $this->voiture_puissance = $voiture_puissance;

        return $this;
    }

    /**
     * Get the value of voiture_annee
     */
    public function getVoitureAnnee(): int
    {
        return $this->voiture_annee;
    }

    /**
     * Set the value of voiture_annee
     */
    public function setVoitureAnnee(int $voiture_annee): self
    {
        $this->voiture_annee = $voiture_annee;

        return $this;
    }

    /**
     * Get the value of voiture_couleur
     */
    public function getVoitureCouleur(): string
    {
        return $this->voiture_couleur;
    }

    /**
     * Set the value of voiture_couleur
     */
    public function setVoitureCouleur(string $voiture_couleur): self
    {
        $this->voiture_couleur = $voiture_couleur;

        return $this;
    }

    /**
     * Get the value of voiture_description
     */
    public function getVoitureDescription(): string
    {
        return $this->voiture_description;
    }

    /**
     * Set the value of voiture_description
     */
    public function setVoitureDescription(string $voiture_description): self
    {
        $this->voiture_description = $voiture_description;

        return $this;
    }
}