<?php
require_once '../utils/autoload.php';
session_start();

if (isset($_SESSION['hero'])) {
    // Récupére l'ID du héros depuis la session
    $heroId = $_SESSION['hero']->getId();

    
    $heroRepository = new HeroRepository();  
    $heroRepository->deleteHeroById($heroId); 

   
    unset($_SESSION['hero']);

  
    header('Location: ../public/home.php');
    exit();
} else {
   
    header('Location: ../home.php');
    exit();
}
