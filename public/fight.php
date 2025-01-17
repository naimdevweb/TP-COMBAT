<?php

require_once '../utils/autoload.php'; 
session_start();
$manager = new FightsManager();



$manager->attributs();




echo $manager->displayfight();
// Lire le contenu brut de la requête
$rawData = file_get_contents("php://input");

// Loggez le contenu brut pour déboguer
error_log("Données reçues : " . $rawData);
var_dump($rawData);

// Vérifier si des données ont été reçues
if (empty($rawData)) {
    error_log("Aucune donnée reçue.");
    echo json_encode(['success' => false, 'message' => 'Aucune donnée reçue.']);
    exit();
}

// Décodez les données JSON envoyées
$data = json_decode($rawData, true);

// Loggez les données décodées
error_log("Données décodées : " . print_r($data, true));

// Vérifiez que les données nécessaires sont présentes
if (isset($data['heroId']) && isset($data['newLevel']) && isset($data['newHp']) && isset($data['newAttack'])) {
    // Récupérer les informations envoyées
    $heroId = $data['heroId'];
    $newLevel = $data['newLevel'];
    $newHp = $data['newHp'];
    $newAttack = $data['newAttack'];

    // Créer une instance de HeroRepository pour récupérer et mettre à jour le héros
    $heroRepo = new HeroRepository();
    $hero = $heroRepo->findHero($heroId); // Trouver le héros par son ID

    if ($hero) {
        // Mettre à jour les attributs du héros
        $hero->setNiveau($newLevel);
        $hero->setHp($newHp);
        $hero->setAttack($newAttack);

        // Sauvegarder les informations mises à jour
        $heroRepo->updateHero($hero); // Appelle la méthode qui va mettre à jour en base

        // Logguez la mise à jour réussie
        error_log("Mise à jour réussie pour le héros ID " . $heroId);

        // Créer une instance de FightsManager pour afficher le combat ou les attributs
        $manager = new FightsManager();
        $manager->attributs(); // Appel de la méthode d'attributs, probablement pour générer le HTML du combat

        // Retourner la réponse avec le succès et afficher le HTML généré
        echo json_encode([
            'success' => true,
            'message' => 'Héros mis à jour avec succès.',
            'newLevel' => $newLevel,
            'newHp' => $newHp,
            'newAttack' => $newAttack,
            'htmlContent' => $manager->displayfight() // Contenu HTML généré par FightsManager
        ]);
    } else {
        // Si le héros n'est pas trouvé dans la base de données
        echo json_encode(['success' => false, 'message' => 'Héros non trouvé.']);
    }
} else {
    // Si les données reçues sont incorrectes ou manquantes
    echo json_encode(['success' => false, 'message' => 'Données manquantes ou incorrectes.']);
}











