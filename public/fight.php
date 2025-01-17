<?php
require_once '../utils/autoload.php'; 
session_start();






$manager = new FightsManager();


$manager->attributs();




echo $manager->displayfight();
