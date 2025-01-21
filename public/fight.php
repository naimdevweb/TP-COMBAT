<?php

require_once '../utils/autoload.php';
session_start();


$heroId = isset($_GET['id']) ? (int)$_GET['id'] : null;


if (!$heroId) {
    header("Location: ../public/home.php?error=nohero");
    exit();
}


$heroRepository = new HeroRepository();
$hero = $heroRepository->findHero($heroId);

if (!$hero) {
    header("Location: ../public/home.php?error=heronotfound");
    exit();
}


$_SESSION['hero'] = $hero;




$manager = new FightsManager();
$manager->setupFight($hero); 


echo $manager->renderFightPage();

?>
