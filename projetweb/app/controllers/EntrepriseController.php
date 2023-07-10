<?php
class EntrepriseController extends Controller
{
    public function model($model)
    {
        require_once 'app/models/' . $model . '.php';
        return new $model();
    }

    public function view($view, $data = [])
    {
        require_once 'app/views/' . $view . '.php';
    }


    public function liste()
    {
        // Créer une instance du modèle Entreprise
        $entreprise = $this->model('Entreprise');

        // Récupérer toutes les entreprises
        $entreprises = $entreprise->getAllEntreprises();

        // Charger la vue "liste.php" avec les données des entreprises
        $this->view('entreprise/liste', ['entreprises' => $entreprises]);
    }

    public function details($id)
    {
        // Créer une instance du modèle Entreprise
        $entreprise = $this->model('Entreprise');

        // Récupérer les détails de l'entreprise par son ID
        $details = $entreprise->getEntrepriseById($id);

        // Charger la vue "details.php" avec les détails de l'entreprise
        $this->view('entreprise/details', ['entreprise' => $details]);
    }

    public function ajouter()
    {
        // Charger le modèle Entreprise
        $this->loadModel('Entreprise');

        // Vérifier si le formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $nom = $_POST['nom'];
            $adresse = $_POST['adresse'];
            $description = $_POST['description'];

            // Appeler une méthode du modèle pour ajouter une nouvelle entreprise
            $nouvelleEntrepriseId = $this->model->ajouterEntreprise($nom, $adresse, $description);

            // Retourner l'ID de la nouvelle entreprise
            return $nouvelleEntrepriseId;
        } else {
            // Retourner le formulaire d'ajout d'entreprise
            return 'Formulaire d\'ajout d\'entreprise';
        }
    }

    public function modifier($id)
    {
        // Charger le modèle Entreprise
        $this->loadModel('Entreprise');

        // Vérifier si le formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $nom = $_POST['nom'];
            $adresse = $_POST['adresse'];
            $description = $_POST['description'];

            // Appeler une méthode du modèle pour mettre à jour les données de l'entreprise
            $this->model->modifierEntreprise($id, $nom, $adresse, $description);

            // Retourner l'ID de l'entreprise modifiée
            return $id;
        } else {
            // Récupérer les détails de l'entreprise à modifier
            $entreprise = $this->model->getEntrepriseById($id);

            // Vérifier si l'entreprise existe
            if ($entreprise) {
                // Retourner les données sous forme de tableau
                return $entreprise;
            } else {
                // Retourner une erreur si l'entreprise n'existe pas
                return 'Erreur 404 - Entreprise non trouvée';
            }
        }
    }

    public function supprimer($id)
    {
        // Charger le modèle Entreprise
        $this->loadModel('Entreprise');

        // Vérifier si l'entreprise existe avant de la supprimer
        if ($this->model->getEntrepriseById($id)) {
            // Appeler une méthode du modèle pour supprimer l'entreprise
            $this->model->supprimerEntreprise($id);

            // Retourner un message de confirmation
            return 'Entreprise supprimée avec succès';
        } else {
            // Retourner une erreur si l'entreprise n'existe pas
            return 'Erreur 404 - Entreprise non trouvée';
        }
    }
}
