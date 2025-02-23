<?php
// Inclure la classe Monstre (vous devrez l'adapter en fonction de votre projet)
require_once 'Monstre.php';  // Adaptez le chemin selon votre structure de projet

// Récupérer le niveau du héros envoyé par la requête GET
$niveauHero = isset($_GET['niveauHero']) ? (int)$_GET['niveauHero'] : 1;

// Créer un monstre en fonction du niveau du héros
$monstre = new Monstre($niveauHero);

// Récupérer les données du monstre
$response = [
    'name' => $monstre->getNom(),
    'image' => $monstre->getImage(),
    'hp' => $monstre->getHp(),
    'attack' => $monstre->getAttack(),
    'level' => $monstre->getNiveauMonstre()
];

// Retourner la réponse en JSON
header('Content-Type: application/json');
echo json_encode($response);
exit();
