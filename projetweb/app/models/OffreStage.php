<?php

class Model
{
    protected $db;

    public function __construct()
    {
        // Initialisez votre connexion à la base de données ici
        $this->db = new PDO('mysql:host=localhost;dbname=web', 'root', '');
    }

    public function query($query)
    {
        return $this->db->query($query);
    }
}




class OffreStage extends Model

{
    public function getAllOffresStage()
    {
        $query = "SELECT * FROM offre_de_stage";
        $result = $this->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOffreStageById($id)
    {
        $query = "SELECT * FROM offre_de_stage WHERE Id = $id";
        $result = $this->query($query);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function ajouterOffreDeStage($titre, $description, $competence)
    {
        $query = "INSERT INTO offres_de_stage (titre_offre_de_stage, description_offre_de_stage, competence_offre_de_stage) VALUES ('$titre', '$description', '$$competence')";
        $this->query($query);
        return $this->db->lastInsertId();
    }

    public function modifierOffreDeStage($id, $titre, $description, $competence)
    {
        $query = "UPDATE offres_de_stage SET titre_offre_de_stage = '$titre', description_offre_de_stage = '$description', competence_offre_de_stage = '$competence' WHERE id = $id";
        $this->query($query);
    }

    public function supprimerOffreDeStage($id)
    {
        $query = "DELETE FROM offres_de_stage WHERE id = $id";
        $this->query($query);
    }
}
