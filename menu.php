<?php

$menuPrincipal = [
    "index.php" => "Accueil", 
    "ajout_annonce.php" => "Créer une annonce", 
    "inscription.php" => "Inscription",
    "connexion.php" => "Connexion",

];

$menuFooter = [
    "mentions.php" => "Mentions légales",
    "politique.php" => "Politique de confidentialite"
];
$menudeconnexion =[
    "index.php" => "Accueil", 
    "ajout_annonce.php" => "Créer une annonce", 
    "inscription.php" => "Inscription",
    "deconnexion.php" => "Déconnexion",

];

function afficher_menu($nom, $liens, $afficherNom = true) { ?>
    <nav>
        
        <?php if ($afficherNom === true) { ?>
            <h2><?php echo $nom; ?></h2>
        <?php } ?>
        <ul>
            <?php foreach($liens as $key=>$value) { ?>
            <li ><a href="<?php echo $key ?>" class="a_menu"><?php echo $value ?></a></li>
            <?php } ?>
        </ul>
    </nav>
<?php }