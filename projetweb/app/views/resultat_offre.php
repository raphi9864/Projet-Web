<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
    <link rel="stylesheet" href="./../../style.css">
    <link rel="stylesheet" href="style_recherche.css">
</head>
<div class="header">

    <a href="./../../index.php" >Acceuil</a>

    <div class="header-right">
        <a href="./entreprise/liste_entreprise.php">Liste des entreprises</a>

        <a href="./etudiant/liste_etudiant.php">Liste des étudiants</a>

        <a href="./offre.stage/liste_offre.php">liste  offres de stage</a>

        <a href="recherche_offre.php">recherche offres de stage</a>
</div>
 


</div>
</html>


<?php
require_once './../../config/database.php';
require_once './../models/Models.php';


// Vérifier si les données du formulaire ont été soumises

// Vérifier si les données du formulaire ont été soumises
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Récupérer les valeurs saisies dans les champs du formulaire
    $titreOffre = $_GET['titre_offre_de_stage'];


    // Construire la requête de recherche
    $sql = "SELECT * FROM offre_de_stage WHERE 1=1";

    // Vérifier si le titre de l'offre a été saisi
    if (!empty($titreOffre)) {
        $sql .= " AND titre_offre_de_stage LIKE '%$titreOffre%'";
    }



    // Exécuter la requête de recherche dans la base de données
    // Remplacez cette partie par votre propre logique d'exécution de la requête et de récupération des résultats

    // Connexion à la base de données
    $connexion = new PDO('mysql:host=localhost;dbname=web', 'root', '');
    // Exécution de la requête
    $resultats = $connexion->query($sql);

    // Vérifier s'il y a des résultats
    if ($resultats->rowCount() > 0) {
        // Parcourir les résultats et afficher les informations de chaque offre
        echo "<h1>Résultats de la recherche</h1>";
        foreach ($resultats as $resultat) {
            $id = $resultat['Id'];
            $titre = $resultat['titre_offre_de_stage'];
            $description = $resultat['description_offre_de_stage'];
            $competences = $resultat['competence_offre_de_stage'];
            $duree = $resultat['dure_du_stage'];
            $datePublication = $resultat['date_de_publication'];

            // Afficher les informations de l'offre
            echo "<h2>$titre</h2>";
            echo "<p><strong>Description :</strong> $description</p>";
            echo "<p><strong>Compétences :</strong> $competences</p>";
            echo "<p><strong>Durée du stage :</strong> $duree</p>";
            echo "<p><strong>Date de publication :</strong> $datePublication</p>";
        }
    } else {
        // Aucun résultat trouvé
        echo "<p>Aucun résultat trouvé.</p>";
    }
}
?>


