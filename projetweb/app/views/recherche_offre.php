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
require_once './../models/Etudiant.php'; // Inclure le fichier contenant la classe Etudiant

$connexion = new PDO('mysql:host=localhost;dbname=web', 'root', '');

// Définir le mode d'erreur PDO sur Exception
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Exemple de requête pour récupérer les titres d'offres de stage
$query = "SELECT DISTINCT titre_offre_de_stage FROM offre_de_stage";
$stmt = $connexion->prepare($query);
$stmt->execute();
$titres = $stmt->fetchAll(PDO::FETCH_COLUMN);

// En cas d'erreur de connexion à la base de données

if (isset($_GET['titre_offre_de_stage']) ) {
    $titreOffre = $_GET['titre_offre_de_stage'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rechercher des offres de stage</title>
</head>
<body>
    <h1>Rechercher des offres de stage</h1>

    <form method="GET" action="resultat_offre.php">
        <label for="titre_offre">Titre de l'offre :</label>
        <select name="titre_offre_de_stage" id="titre_offre_de_stage">
            <option value="">Sélectionner un titre</option>
            <?php foreach ($titres as $titre) : ?>
                <option value="<?php echo $titre; ?>"><?php echo $titre; ?></option>
            <?php endforeach; ?>
        </select>

        <input type="submit" value="Rechercher">
    </form>
</body>
</html>
