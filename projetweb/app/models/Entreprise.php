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

class Entreprise extends Model
{
    public function getAllEntreprises()
    {
        $query = "SELECT * FROM entreprise";
        $result = $this->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getOffresStageByEntrepriseId($entrepriseId)
    {
        $query = "SELECT * FROM offres_stage WHERE entreprise_id = $entrepriseId";
        $result = $this->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getEntrepriseById($id)
    {
        $query = "SELECT * FROM entreprise WHERE id_entreprise = $id";
        $result = $this->query($query);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function ajouterEntreprise($nom, $adresse, $description)
    {
        $query = "INSERT INTO entreprise (nom_entreprise, adresse_entreprise, description_entreprise) VALUES ('$nom', '$adresse', '$description')";
        $this->query($query);
        return $this->db->lastInsertId();
    }

    public function modifierEntreprise($id, $nom, $adresse, $description)
    {
        $query = "UPDATE entreprise SET nom_entreprise = '$nom', adresse_entreprise = '$adresse', description_entreprise = '$description' WHERE id_Entreprise = $id";
        $this->query($query);
    }

    public function supprimerEntreprise($id)
    {
        $query = "DELETE FROM entreprise WHERE id = $id";
        $this->query($query);
    }
}
