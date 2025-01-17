<?php
require_once '../utils/autoload.php';


$security = new SecurityService();


if (!isset($_POST['nom'], $_POST['image'], $_POST['hp'], $_POST['attack'])) {
    header("Location: ../public/home.php?error=missing");
    exit();
}

// A refaire le ssang
// $security->securite($_POST['nom'], $_POST['image'], $_POST['hp'], $_POST['attack']);
$nom = $_POST['nom'];
$image = $_POST['image'];
// Transform to int
$heroHp = (int)$_POST['hp'];
$heroAttack = (int)$_POST['attack'];
$niveau = 1;

$heroRepository = new HeroRepository();

$hero = $heroRepository->save($nom, $image,$heroAttack,$heroHp,$niveau);

session_start();

$_SESSION['hero'] = $hero;




 // Redirection après la création réussie
               header("Location: ../public/carteHero.php");
                exit();

?>