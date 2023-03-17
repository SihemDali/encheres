<?php

require __DIR__."/pdo.php";
require_once __DIR__."/menu.php";

$query = $pdo->prepare('SELECT * FROM annonce');


$query->execute();

// On récupère un tableau avec un utilsateur par ligne
// On utilise fetchAll
$annonces = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Document</title>

</head>
<body >

<header>
  
    <h1>AFFAIRE . CONCLUE . AUTO</h1>
    
<?php 
include __DIR__ . "/session.php";
if (isset($_SESSION["nom"])){
   // echo $_SESSION["nom"];
    afficher_menu("Menu principal", $menudeconnexion, false );
}
else {
    afficher_menu("Menu principal", $menuPrincipal, false );
}
        

?>
</header>

<div>
<img src="/images/Mini.jpg" alt="" class="image_fond">
</div>

<main class="annonces">


<?php
foreach ($annonces as $key => $annonce) { ?>

<h2><?php echo $annonce["voiture_marque"]. " : ". $annonce["voiture_modele"]. " , année: " . $annonce["voiture_annee"] ;?></h2>
<div class="annonce">
<p> Prix de réserve : <?php echo $annonce["prix_depart"]; ?></p>
<p> Date de fin des enchères : <?php echo $annonce["date_fin"]; ?></p>
<a href="detail_annonce.php?id=<?php echo $annonce["id"];?> ">Detail de l'annonce </a>
</div>

<?php }
?>
</main>


<div>
<?php require_once __DIR__."/footer.php"; ?>  
</div>

</body>
</html>










