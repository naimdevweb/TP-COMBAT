<?php
require_once '../utils/autoload.php';
session_start();

if (isset($_SESSION['hero'])) {
    
    $monHero = $_SESSION['hero'];
    var_dump($monHero); 

   
    if ($monHero instanceof Hero) {
       
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          
            $heroId = $_POST['heroId'];
            $newLevel = $_POST['newLevel'];
            $newHp = $_POST['newHp'];
            $newAttack = $_POST['newAttack'];

        
            if ($monHero->getId() == $heroId) {
               
                $monHero->setNiveau($newLevel);
                $monHero->setHp($newHp);
                $monHero->setAttack($newAttack);

                $heroRepository = new HeroRepository();  

             
                $heroRepository->updateHero($monHero);
                
                $_SESSION['hero'] = $monHero;
               

              

              
                header('Location: ../public/fight.php');  
                exit();
            } else {
              
                header('Location: ../home.php');
                exit();
            }
        }
    } else {
        
        header('Location: ../home.php');
        exit();
    }
} else {
  
    header('Location: ./home.php?error=1');
    exit();
}
