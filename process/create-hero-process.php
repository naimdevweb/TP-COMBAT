<?php
require_once '../utils/autoload.php';


$security = new SecurityService();


if (!isset($_POST['nom'], $_FILES['image'], $_POST['hp'], $_POST['attack'])) {
    header("Location: ../public/home.php?error=missing");
    exit();
}
$file = $_FILES["image"];

    $uploadDir = '../public/assets/image/';

    $fileName = uniqid() . basename($file['name']);

    $uploadPath = $uploadDir . $fileName;


    move_uploaded_file($file['tmp_name'], $uploadPath);

    // On récupère le filename et on le met l'array final
    $sanitizedPOST["filename"] = $fileName;
// A refaire le ssang
// $security->securite($_POST['nom'], $_POST['image'], $_POST['hp'], $_POST['attack']);
$nom = $_POST['nom'];
$image = $fileName;
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