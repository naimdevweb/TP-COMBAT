<?php
require_once '../utils/autoload.php'; 
session_start();

// Lire le contenu brut de la requête
$rawData = file_get_contents("php://input");

// Loggez le contenu brut pour déboguer
error_log("Données reçues : " . $rawData);

// Vérifier si des données ont été reçues
if (empty($rawData)) {
    error_log("Aucune donnée reçue.");
    echo json_encode(['success' => false, 'message' => 'Aucune donnée reçue.']);
    exit;
}

// Décodez les données JSON envoyées
$data = json_decode($rawData, true);

// Loggez les données décodées
error_log("Données décodées : " . print_r($data, true));

// Vérifiez les données
if (isset($data['heroId']) && isset($data['newLevel']) && isset($data['newHp']) && isset($data['newAttack'])) {
    $heroId = $data['heroId'];
    $newLevel = $data['newLevel'];
    $newHp = $data['newHp'];
    $newAttack = $data['newAttack'];

    // Mise à jour du héros (par exemple)
    $heroRepo = new HeroRepository();
    $hero = $heroRepo->findHero($heroId);
    if ($hero) {
        $hero->setAttack($newAttack);
        $hero->setHp($newHp);
        $hero->setNiveau($newLevel);

        // Sauvegarde dans la base de données
        $hero->saveHero($hero);

        // Réponse en JSON avec les nouvelles stats
        echo json_encode([
            'success' => true,
            'message' => 'Héros mis à jour avec succès.',
            'newLevel' => $hero->getNiveau(),
            'newHp' => $hero->getHp(),
            'newAttack' => $hero->getAttack()
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Héros non trouvé.']);
    }
} else {
    error_log("Données manquantes ou incorrectes.");
    echo json_encode(['success' => false, 'message' => 'Données manquantes.']);
}
