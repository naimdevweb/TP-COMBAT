<?php
require_once '../utils/autoload.php';
session_start();

$heroRepository = new HeroRepository();
$heroes = $heroRepository->findAllHeroes();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $heroId = $_POST['hero_id'];
    $hero = $heroRepository->findHero($heroId);

    if ($hero) {
        $_SESSION['hero'] = $hero;
        header("Location: fight.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Héros</title>
    <link rel="stylesheet" href="./assets/css/style.css"> 
</head>
<body class="bodyhero">

    <h1 class="heroes">Liste des Héros</h1>

    <div class="heroes-container">
        <?php foreach ($heroes as $hero): ?>
            <div class="hero-card">
                <img src="./assets/image/<?= htmlspecialchars($hero->getImage()) ?>" alt="" class="hero-image">
                <h2><?php echo $hero->getNom(); ?></h2>
                <p><strong>Attaque:</strong> <?php echo $hero->getAttack(); ?></p>
                <p><strong>Points de vie:</strong> <?php echo $hero->getHp(); ?></p>
                <p><strong>Niveau:</strong> <?php echo $hero->getNiveau(); ?></p>
                <a class="choisir" href="../public/fight.php?id=<?= $hero->getId(); ?>">Choisir</a>
            </div>
        <?php endforeach; ?>
    </div>

</body>
</html>