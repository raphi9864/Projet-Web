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

class Etudiant extends Model
{
    public function rechercherOffresStage($titreOffre, $competences)
    {
        // Préparer la requête SQL en utilisant les critères de recherche
        $sql = "SELECT * FROM offre_de_stage WHERE titre_offre_de_stage LIKE :titreOffre AND competence_offre_de_stage LIKE :competences";
    
        // Ajouter des caractères joker (%) aux critères pour effectuer une recherche partielle
        $titreOffre = '%' . $titreOffre . '%';
        $competences = '%' . $competences . '%';
    
        // Préparer et exécuter la requête
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':titreOffre', $titreOffre);
        $stmt->bindParam(':competences', $competences);
    
        // Exécuter la requête
        $stmt->execute();
    
        // Récupérer les résultats de la requête
        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Retourner les résultats
        return $resultats;
    }
    
    
    public function getAllEtudiants()
    {
        $query = "SELECT * FROM etudiants";
        $result = $this->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEtudiantById($id)
    {
        $query = "SELECT * FROM etudiants WHERE id = $id";
        $result = $this->query($query);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function ajouterEtudiant($nom, $prenom, $adresse)
    {
        $query = "INSERT INTO etudiants (nom, prenom, adresse) VALUES ('$nom', '$prenom', '$adresse')";
        $this->query($query);
        return $this->db->lastInsertId();
    }

    public function modifierEtudiant($id, $nom, $prenom, $adresse)
    {
        $query = "UPDATE etudiants SET nom = '$nom', prenom = '$prenom', adresse = '$adresse' WHERE id = $id";
        $this->query($query);
    }

    public function supprimerEtudiant($id)
    {
        $query = "DELETE FROM etudiants WHERE id = $id";
        $this->query($query);
    }
}

class OffreDeStage extends Model
{
    public function getAllOffresDeStage()
    {
        $query = "SELECT * FROM offres_de_stage";
        $result = $this->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOffreDeStageById($id)
    {
        $query = "SELECT * FROM offres_de_stage WHERE id = $id";
        $result = $this->query($query);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function ajouterOffreDeStage($titre, $description, $entreprise)
    {
        $query = "INSERT INTO offres_de_stage (titre, description, entreprise) VALUES ('$titre', '$description', '$entreprise')";
        $this->query($query);
        return $this->db->lastInsertId();
    }
    public function ajouterOffreWishlist($etudiantId, $offreId)
    {
        // Vérifier si l'offre de stage n'est pas déjà dans la wish-list de l'étudiant
        $query = "SELECT COUNT(*) as count FROM wishlist WHERE etudiant_id = :etudiantId AND offre_stage_id = :offreId";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':etudiantId', $etudiantId);
        $stmt->bindParam(':offreId', $offreId);
        $stmt->execute();
        $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

        if ($count > 0) {
            // L'offre de stage est déjà dans la wish-list, vous pouvez afficher un message d'erreur ou effectuer une autre action
            return false;
        }

        // Insérer l'offre de stage dans la wish-list de l'étudiant
        $query = "INSERT INTO wishlist (etudiant_id, offre_stage_id) VALUES (:etudiantId, :offreId)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':etudiantId', $etudiantId);
        $stmt->bindParam(':offreId', $offreId);
        $stmt->execute();

        return true;
    }

}

