<?php

require_once '../utils/autoload.php';
session_start();

// Vérifiez si un ID de héros est passé dans l'URL
if (isset($_GET['id'])) {
    $heroId = (int)$_GET['id'];
    

    // Récupérez le héros à partir de la base de données en utilisant l'ID
    $heroRepository = new HeroRepository();
    $hero = $heroRepository->findHero($heroId);

    // Vérifiez si le héros existe dans la base de données
    if (!$hero) {
        header("Location: ../public/home.php?error=heronotfound");
        exit();
    }

    // Mettez à jour la session avec le héros récupéré de la base de données
    $_SESSION['hero'] = $hero;
   
} else {
    // Vérifiez si un héros est déjà stocké dans la session
    if (!isset($_SESSION["hero"]) || null === $_SESSION["hero"]->getId()) {
        header("Location: ../public/home.php?error=nohero");
        exit();
    }

    $hero = $_SESSION["hero"];
    $heroId = $hero->getId();

    if (!$heroId) {
        header("Location: ../public/home.php?error=nohero1");
        exit();
    }
}

$manager = new FightsManager();
$manager->setupFight($hero);

echo $manager->renderFightPage();
?>