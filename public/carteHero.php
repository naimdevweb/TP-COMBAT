<?php
require_once '../utils/autoload.php';
session_start();

$heroRepository = new HeroRepository();

// Vérifier si le héros est présent dans la session
if (isset($_SESSION['hero'])) {
    $monHero = $_SESSION['hero'];
     
   
    if ($monHero instanceof Hero) {
       
        $nom = $monHero->getImage();
        $hp = $monHero->getHp();
        $img = $monHero->getNom(); 
        $id = $monHero->getId();
        $attack = $monHero->getAttack();
    } else {
        echo "Le héros dans la session n'est pas valide.";
       
        die();

    }
} else {
    echo "Aucun héros trouvé dans la session.";
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afficher le Héros</title>
    <!-- Lier le fichier CSS externe -->
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>

<div class="hero-card">
   
    <img src="./assets/image/<?= $img ?>" alt="image du hero">

    
    <div class="hero-name"><?= htmlspecialchars($nom) ?></div>

    
    <div class="hero-details">
       
        <p class="hp">HP: <?= htmlspecialchars($hp) ?></p>
    </div>


    <div class="hero-details">
       
       <p  class="hp">Attack: <?= htmlspecialchars($attack) ?></p>
   </div>

   
    <a href="./fight.php" class="ready-link" onclick="alert('<?= htmlspecialchars($nom) ?> est prêt à combattre !')">Prêt à combattre</a>


   
</div>

</body>
</html>
