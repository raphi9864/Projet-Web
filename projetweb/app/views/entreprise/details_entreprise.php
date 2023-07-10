<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
    <link rel="stylesheet" href="./../../../style.css">
</head>
<div class="header">

    <a href="./../../../index.php" >Acceuil</a>

    <ul class="header-right">
        <a href="liste_entreprise.php">Liste des entreprises</a>

        <a href="./../etudiant/liste_etudiant.php">Liste des étudiants</a>

        <a href="./../offre.stage/liste_offre.php">liste  offres de stage</a>

        <a href="./../recherche_offre.php">recherche offres de stage</a>
    </ul>
 


</div>
</html>



<?php
require_once './../../../config/database.php';
require_once './../../models/Entreprise.php';

// Vérifier si un ID d'entreprise a été passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Créer une instance du modèle Entreprise
    $entreprise = new Entreprise();

    // Récupérer les détails de l'entreprise par son ID
    $details = $entreprise->getEntrepriseById($id);

    // Vérifier si les détails ont été trouvés
    if ($details) {
        $nom = $details['nom_entreprise'];
        $adresse = $details['adresse_entreprise'];
        $description = $details['description_entreprise'];
        
        // Affichage des détails de l'entreprise


    } else {
        // Aucun détail d'entreprise trouvé
        echo "<p>Aucun détail d'entreprise trouvé.</p>";
    }
    
}

?>
<div class="php-output" >
    <?php
    echo "<h1>Détails Entreprise</h1>";
    echo "<h2>" . $nom . "</h2>";
    echo "<p><strong>Adresse:</strong> " . $adresse . "</p>";
    echo "<p><strong>Description:</strong> " . $description . "</p>";
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