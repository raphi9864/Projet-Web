<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
    <link rel="stylesheet" href="./../../../style.css">
    <link rel="stylesheet" href="style_entreprise.css">
</head>
<div class="header">

    <a href="./../../../index.php" >Acceuil</a>

    <div class="header-right">
    <a href="liste_entreprise.php">Liste des entreprises</a>

<a href="./../etudiant/liste_etudiant.php">Liste des étudiants</a>

<a href="./../offre.stage/liste_offre.php">liste  offres de stage</a>

<a href="./../recherche_offre.php">recherche offres de stage</a>
</div>
 


</div>
</html>




<?php
require_once './../../models/Entreprise.php';
require_once './../../../config/database.php';
$entreprise = new Entreprise();

// Récupérer toutes les entreprises
$entreprises = $entreprise->getAllEntreprises();


?>
<!DOCTYPE html>
<html>
<head>
    <title>Liste des entreprises</title>
</head>
<body>
    <h1>Liste des entreprises</h1>

    <?php if (count($entreprises) > 0): ?>
        <ul>
            <?php foreach ($entreprises as $entreprise): ?>
                <li>
                <a href="details_entreprise.php?id=<?php echo $entreprise['id_entreprise']; ?>">
                   <?php echo $entreprise['nom_entreprise']; ?>
</a>
                                              
                       
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucune entreprise trouvée.</p>
    <?php endif; ?>

</body>
</html>
