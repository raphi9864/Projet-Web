<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
    <link rel="stylesheet" href="./../../../style.css">
    <link rel="stylesheet" href="style_etudiant.css">
</head>
<div class="header">

    <a href="./../../../index.php" >Acceuil</a>

    <div class="header-right">
        <a href="./../entreprise/liste_entreprise.php">Liste des entreprises</a>

        <a href="liste_etudiant.php">Liste des étudiants</a>

        <a href="./../offre.stage/liste_offre.php">liste  offres de stage</a>

        <a href="./../recherche_offre.php">recherche offres de stage</a>
</div>
 


</div>
</html>
<?php
require_once './../../models/Etudiant.php';
require_once './../../../config/database.php';
$etudiant = new Etudiant();

// Récupérer toutes les entreprises
$etudiants = $etudiant->getAllEtudiants();


?>




<!DOCTYPE html>
<html>
<head>
    <title>Liste des étudiants</title>
</head>
<body>
    <h1>Liste des étudiants</h1>
    <ul>
        <?php foreach ($etudiants as $etudiant): ?>
            <li>
                <a href="details_etudiant.php?id=<?php echo $etudiant['id_etudiant']; ?>">
                    <?php echo $etudiant['nom_etudiant'] . ' ' . $etudiant['prenom_etudiant']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
