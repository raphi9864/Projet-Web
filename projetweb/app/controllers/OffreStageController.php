<?php
class OffreStageController extends Controller
{
    public function liste()
    {
        // Charger le modèle OffreStage
        $this->loadModel('OffreStage');

        // Appeler une méthode du modèle pour récupérer la liste des offres de stage
        $offres = $this->model->getAllOffresStage();

        // Retourner les données sous forme de tableau
        return $offres;
    }

    public function details($id)
    {
        // Charger le modèle OffreStage
        $this->loadModel('OffreStage');

        // Appeler une méthode du modèle pour récupérer les détails de l'offre de stage spécifiée par l'id
        $offre = $this->model->getOffreStageById($id);

        // Vérifier si l'offre de stage existe
        if ($offre) {
            // Retourner les données sous forme de tableau
            return $offre;
        } else {
            // Retourner une erreur si l'offre de stage n'existe pas
            return 'Erreur 404 - Offre de stage non trouvée';
        }
    }

    public function ajouter()
    {
        // Charger le modèle OffreStage
        $this->loadModel('OffreStage');

        // Vérifier si le formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $idEntreprise = $_POST['id_entreprise'];
            $titre = $_POST['titre'];
            $description = $_POST['description'];
            $competences = $_POST['competences'];
            $duree = $_POST['duree'];
            $datePublication = $_POST['date_publication'];

            // Appeler une méthode du modèle pour ajouter une nouvelle offre de stage
            $nouvelleOffreId = $this->model->ajouterOffreStage($idEntreprise, $titre, $description, $competences, $duree, $datePublication);

            // Retourner l'ID de la nouvelle offre de stage
            return $nouvelleOffreId;
        } else {
            // Retourner le formulaire d'ajout d'offre de stage
            return 'Formulaire d\'ajout d\'offre de stage';
        }
    }

    public function modifier($id)
    {
        // Charger le modèle OffreStage
        $this->loadModel('OffreStage');

        // Vérifier si le formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $idEntreprise = $_POST['id_entreprise'];
            $titre = $_POST['titre'];
            $description = $_POST['description'];
            $competences = $_POST['competences'];
            $duree = $_POST['duree'];
            $datePublication = $_POST['date_publication'];

            // Appeler une méthode du modèle pour mettre à jour les données de l'offre de stage
            $this->model->modifierOffreStage($id, $idEntreprise, $titre, $description, $competences, $duree, $datePublication);

            // Retourner l'ID de l'offre de stage modifiée
            return $id;
        } else {
            // Récupérer les détails de l'offre de stage à modifier
            $offre = $this->model->getOffreStageById($id);

            // Vérifier si l'offre de stage existe
            if ($offre) {
                // Retourner les données sous forme de tableau
                return $offre;
            } else {
                // Retourner une erreur si l'offre de stage n'existe pas
                return 'Erreur 404 - Offre de stage non trouvée';
            }
        }
    }

    public function supprimer($id)
    {
        // Charger le modèle OffreStage
        $this->loadModel('OffreStage');

        // Vérifier si l'offre de stage existe avant de la supprimer
        if ($this->model->getOffreStageById($id)) {
            // Appeler une méthode du modèle pour supprimer l'offre de stage
            $this->model->supprimerOffreStage($id);

            // Retourner un message de confirmation
            return 'Offre de stage supprimée avec succès';
        } else {
            // Retourner une erreur si l'offre de stage n'existe pas
            return 'Erreur 404 - Offre de stage non trouvée';
        }
    }
}
