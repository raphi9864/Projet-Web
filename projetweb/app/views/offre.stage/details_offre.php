<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
    <link rel="stylesheet" href="./../../../style.css">
    <link rel="stylesheet" href="style_offre.css">
    
</head>
<div class="header">

    <a href="./../../../index.php" >Accueil</a>

    <div class="header-right">
        <a href="./../entreprise/liste_entreprise.php">Liste des entreprises</a>

        <a href="./../etudiant/liste_etudiant.php">Liste des étudiants</a>

        <a href="liste_offre.php">Liste des offres de stage</a>

        <a href="./../recherche_offre.php">Recherche d'offres de stage</a>
    </div>
</div>
 
<?php
require_once './../../../config/database.php';
require_once './../../models/OffreStage.php';

// Vérifier si un ID d'offre a été passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Créer une instance du modèle OffreStage
    $offreStage = new OffreStage();

    // Récupérer les détails de l'offre de stage par son ID
    $details = $offreStage->getOffreStageById($id);

    // Vérifier si les détails ont été trouvés
    if ($details) {
        $titre = $details['titre_offre_de_stage'];
        $description = $details['description_offre_de_stage'];
        $competences = $details['competence_offre_de_stage'];
        $duree = $details['dure_du_stage'];
        $datePublication = $details['date_de_publication'];
    } else {
        // Aucun détail d'offre de stage trouvé
        echo "<p>Aucun détail d'offre de stage trouvé.</p>";
        exit();
    }
} else {
    // ID d'offre non spécifié dans l'URL
    echo "<p>Identifiant d'offre non spécifié.</p>";
    exit();
}
if (isset($_POST['postuler'])) {
    // Traitez la demande de postulation

    // Définissez le message de confirmation en tant que variable de session
    session_start();
    $_SESSION['message_confirmation'] = "Vous avez postulé avec succès.";

    // Redirigez vers la page avec l'en-tête
    header("Location: ./../etudiant/details_etudiant.php?id=1");
    exit();
}


?>

<div class="php-output">
    <h1>Détails de l'offre</h1>
    <h2><?php echo $titre; ?></h2>
    <p><strong>Description :</strong> <?php echo $description; ?></p>
    <p><strong>Compétences :</strong> <?php echo $competences; ?></p>
    <p><strong>Durée du stage :</strong> <?php echo $duree; ?></p>
    <p><strong>Date de publication :</strong> <?php echo $datePublication; ?></p>

    <button class="btn-ajouter-wishlist" data-offre-id="<?php echo $id; ?>">Ajouter à la wishlist</button>
    <button class="btn-retirer-wishlist" data-offre-id="<?php echo $id; ?>">Retirer de la wishlist</button>
    <form action="./../etudiant/details_etudiant.php?id=1" method="POST">
    <button type="submit" name="postuler">Postuler</button>
    </form>
   
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.btn-ajouter-wishlist').click(function(e) {
        e.preventDefault();

        // Récupérer l'ID de l'offre
        var offreId = $(this).data('offre-id');

        // Envoyer une requête Ajax pour ajouter l'offre à la wishlist
        $.ajax({
            url: 'wishlist.php',
            type: 'POST',
            data: {
                action: 'add',
                offre_id: offreId
            },
            dataType: 'json',
            success: function(response) {
                // Afficher le message de succès
                $('#message').text(response.message);
            },
            error: function(xhr, status, error) {
                // Afficher une erreur en cas de problème avec la requête Ajax
                $('#message').text('Succés de l\'ajout à la wishlist');
                console.log(xhr.responseText);
            }
        });
    });

    $('.btn-retirer-wishlist').click(function(e) {
        e.preventDefault();

        // Récupérer l'ID de l'offre
        var offreId = $(this).data('offre-id');

        // Envoyer une requête Ajax pour supprimer l'offre de la wishlist
        $.ajax({
            url: 'retirer.php',
            type: 'POST',
            data: {
                action: 'remove',
                offre_id: offreId
            },
            dataType: 'json',
            success: function(response) {
                // Afficher le message de succès
                $('#message').text(response.message);
            },
            error: function(xhr, status, error) {
                // Afficher une erreur en cas de problème avec la requête Ajax
                $('#message').text('Erreur lors du retrait de la wishlist');
                console.log(xhr.responseText);
            }
        });
    });
});
</script>