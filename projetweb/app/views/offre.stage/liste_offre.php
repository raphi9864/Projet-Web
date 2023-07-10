<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
    <link rel="stylesheet" href="./../../../style.css">
    <link rel="stylesheet" href="style_offre.css">
</head>
<div class="header">

    <a href="./../../../index.php" >Acceuil</a>

    <div class="header-right">
        <a href="./../entreprise/liste_entreprise.php">Liste des entreprises</a>

        <a href="./../etudiant/liste_etudiant.php">Liste des étudiants</a>

        <a href="liste_offre.php">liste  offres de stage</a>

        <a href="./../recherche_offre.php">recherche offres de stage</a>
</div>
 


</div>
</html>

<?php
require_once './../../../config/database.php';
require_once './../../models/OffreStage.php';

// Créer une instance du modèle OffreDeStage
$offreStage = new OffreStage();

// Récupérer toutes les offres de stage
$offres = $offreStage->getAllOffresStage();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des offres de stage</title>
</head>
<body>
    <h1>Liste des offres de stage</h1>
    <ul>
        <?php foreach ($offres as $offre): ?>
            <li>
                <a href="details_offre.php?id=<?php echo $offre['Id']; ?>">
                    <?php echo $offre['titre_offre_de_stage']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
