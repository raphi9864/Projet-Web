<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
    <link rel="stylesheet" href="./../../../style.css">
</head>
<div class="header">

    <a href="./../../../index.php" >Acceuil</a>

    <ul class="header-right">
        <a href="./../entreprise/liste_entreprise.php">Liste des entreprises</a>

        <a href="liste_etudiant.php">Liste des étudiants</a>

        <a href="./../offre.stage/liste_offre.php">liste  offres de stage</a>

        <a href="./../recherche_offre.php">recherche offres de stage</a>
    </ul>
 


</div>
</html>





<?php
require_once './../../../config/database.php';
require_once './../../models/Etudiant.php';

// Vérifier si un ID d'étudiant a été passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Créer une instance du modèle Etudiant
    $etudiant = new Etudiant();

    // Récupérer les détails de l'étudiant par son ID
    $details = $etudiant->getEtudiantById($id);

    // Vérifier si les détails ont été trouvés
    if ($details) {
        $prenom = $details['prenom_etudiant'];
        $nom = $details['nom_etudiant'];
        $email = $details['email_etudiant'];

        // Affichage des détails de l'étudiant
   
    } else {
        // Aucun détail d'étudiant trouvé
        echo "<p>Aucun détail d'étudiant trouvé.</p>";
    }
// Afficher le message de confirmation s'il est défini

session_start();

// Vérifiez si un message de confirmation est défini dans la session
if (isset($_POST['postuler'])) {
    // Traitement de la demande de postulation
    // ...

    // Redirection vers la page d'étudiant avec un message de confirmation
    header('Location: details_etudiant.php?id=1&message=Vous avez postulé avec succès.');
    exit();
}

// Affichage du message de confirmation si présent dans l'URL


}
?>

<div class="php-output">
    <?php
        echo "<h1>Details Etudiant </h1>";
        echo "<h2>$prenom $nom</h2>";
        echo "<p><strong>Email:</strong> $email</p>";
        if (isset($_GET['message'])) {
            echo "<p>" . $_GET['message'] . "</p>";
        }
    ?>
  
</div>
<script>
    const phpOutput = document.querySelector('.php-output');
    phpOutput.style.transform = 'translateX(-100%)';
    phpOutput.style.opacity = '0';

    setTimeout(() => {
        phpOutput.style.transition = 'transform 1s ease-in-out, opacity 1s ease-in-out';
        phpOutput.style.transform = 'translateX(0)';
        phpOutput.style.opacity = '1';
    }, 100);
</script>