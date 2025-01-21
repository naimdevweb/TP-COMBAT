<?php
require_once '../utils/autoload.php';

$security = new SecurityService();



if (!$heroes) {
    header("Location: ./home.php");
    exit;
}

if (!isset($_POST['nom'], $_FILES['image'])) {
    header("Location: ../public/home.php?error=missing");
    exit();
}

$file = $_FILES["image"];


$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif']; 
$fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));


if (!in_array($fileExtension, $allowedExtensions)) {
    header("Location: ../public/home.php?error=invalid_file");
    exit();
}


$uploadDir = '../public/assets/image/';
$fileName = uniqid() . '.' . $fileExtension;
$uploadPath = $uploadDir . $fileName;


if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
    header("Location: ../public/home.php?error=upload_failed");
    exit();
}


$sanitizedPOST["filename"] = $fileName;


$nom = htmlspecialchars($_POST['nom']);  
$image = $fileName;  
$heroHp = isset($_POST['hp']) ? (int)$_POST['hp'] : 100;  
$heroAttack = isset($_POST['attack']) ? (int)$_POST['attack'] : 20;  
$niveau = 1;  


$heroRepository = new HeroRepository();
$hero = $heroRepository->save($nom, $image, $heroAttack, $heroHp, $niveau);


session_start();
$_SESSION['hero'] = $hero;


header("Location: ../public/carteHero.php");
exit();
?>
