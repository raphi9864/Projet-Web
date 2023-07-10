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

class Etudiant extends Model
{
    
    public function rechercherOffresStage($nomEntreprise, $competences)
{
    // Préparer la requête SQL en utilisant les critères de recherche
    $sql = "SELECT * FROM offres_stage WHERE nom_entreprise LIKE :nomEntreprise AND competences LIKE :competences";

    // Ajouter des caractères joker (%) aux critères pour effectuer une recherche partielle
    $nomEntreprise = '%' . $nomEntreprise . '%';
    $competences = '%' . $competences . '%';

    // Préparer et exécuter la requête
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':nomEntreprise', $nomEntreprise);
    $stmt->bindParam(':competences', $competences);
    $stmt->execute();

    // Récupérer les résultats de la requête
    $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retourner les résultats
    return $resultats;
}

    public function getAllEtudiants()
    {
        $query = "SELECT * FROM etudiant";
        $result = $this->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEtudiantById($id)
    {
        $query = "SELECT * FROM etudiant WHERE id_etudiant = $id";
        $result = $this->query($query);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function ajouterEtudiant($nom, $prenom, $adresse)
    {
        $query = "INSERT INTO etudiant (nom_etudiant, prenom_etudiant, email_etudiant) VALUES ('$nom', '$prenom', '$adresse')";
        $this->query($query);
        return $this->db->lastInsertId();
    }

    public function modifierEtudiant($id, $nom, $prenom, $adresse)
    {
        $query = "UPDATE etudiant SET nom_etudiant = '$nom', prenom_etudiant = '$prenom', email_etudiant = '$adresse' WHERE id = $id";
        $this->query($query);
    }

    public function supprimerEtudiant($id)
    {
        $query = "DELETE FROM etudiant WHERE id_etudiant = $id";
        $this->query($query);
    }
    public function __construct() {
        parent::__construct();
    }

    public function attribuerOffreStage($offreId) {
        // Récupérer tous les étudiants
        $etudiants = $this->getAllEtudiants();

        // Générer un index aléatoire
        $index = rand(0, count($etudiants) - 1);

        // Récupérer l'étudiant correspondant à l'index
        $etudiant = $etudiants[$index];

        // Associer l'offre de stage à l'étudiant
        $this->associerOffreStage($etudiant['id_etudiant'], $offreId);

        // Retourner l'étudiant attribué
        return $etudiant;
    }
    private function associerOffreStage($etudiantId, $offreId) {
        // Code pour associer l'offre de stage à l'étudiant dans la base de données
        $query = "INSERT INTO wishlist (etudiant_id, offre_stage_id) VALUES ($etudiantId, $offreId)";
        $this->query($query);
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
