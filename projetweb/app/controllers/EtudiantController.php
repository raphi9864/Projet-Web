<?php
class EtudiantController extends Controller
{
    public function liste()
    {
        // Charger le modèle Etudiant
        $this->loadModel('Etudiant');

        // Appeler une méthode du modèle pour récupérer la liste des étudiants
        $etudiants = $this->model->getAllEtudiants();

        // Retourner les données sous forme de tableau
        return $etudiants;
    }

    public function details($id)
    {
        // Charger le modèle Etudiant
        $this->loadModel('Etudiant');

        // Appeler une méthode du modèle pour récupérer les détails de l'étudiant spécifié par l'id
        $etudiant = $this->model->getEtudiantById($id);

        // Vérifier si l'étudiant existe
        if ($etudiant) {
            // Retourner les données sous forme de tableau
            return $etudiant;
        } else {
            // Retourner une erreur si l'étudiant n'existe pas
            return 'Erreur 404 - Étudiant non trouvé';
        }
    }

    public function ajouter()
    {
        // Charger le modèle Etudiant
        $this->loadModel('Etudiant');

        // Vérifier si le formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];

            // Appeler une méthode du modèle pour ajouter un nouvel étudiant
            $nouvelEtudiantId = $this->model->ajouterEtudiant($nom, $prenom, $email);

            // Retourner l'ID du nouvel étudiant
            return $nouvelEtudiantId;
        } else {
            // Retourner le formulaire d'ajout d'étudiant
            return 'Formulaire d\'ajout d\'étudiant';
        }
    }

    public function modifier($id)
    {
        // Charger le modèle Etudiant
        $this->loadModel('Etudiant');

        // Vérifier si le formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];

            // Appeler une méthode du modèle pour mettre à jour les données de l'étudiant
            $this->model->modifierEtudiant($id, $nom, $prenom, $email);

            // Retourner l'ID de l'étudiant modifié
            return $id;
        } else {
            // Récupérer les détails de l'étudiant à modifier
            $etudiant = $this->model->getEtudiantById($id);

            // Vérifier si l'étudiant existe
            if ($etudiant) {
                // Retourner les données sous forme de tableau
                return $etudiant;
            } else {
                // Retourner une erreur si l'étudiant n'existe pas
                return 'Erreur 404 - Étudiant non trouvé';
            }
        }
    }

    public function supprimer($id)
    {
        // Charger le modèle Etudiant
        $this->loadModel('Etudiant');

        // Vérifier si l'étudiant existe avant de le supprimer
        if ($this->model->getEtudiantById($id)) {
            // Appeler une méthode du modèle pour supprimer l'étudiant
            $this->model->supprimerEtudiant($id);

            // Retourner un message de confirmation
            return 'Étudiant supprimé avec succès';
        } else {
            // Retourner une erreur si l'étudiant n'existe pas
            return 'Erreur 404 - Étudiant non trouvé';
        }
    }
}

?>