<?php

require_once '../utils/autoload.php';
session_start();


if (!isset($_SESSION["hero"])) {
    header("Location: ../public/home.php?error=nohero");
    exit();
}

$hero = $_SESSION["hero"];

$heroId = $hero->getId();



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
