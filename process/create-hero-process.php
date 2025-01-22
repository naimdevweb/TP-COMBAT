<?php


include "../utils/autoload.php";
session_start();

$validator = new ValidatorService();

$validator->checkMethods('POST');

// Validation des données POST
$validator->addStrategy("nom", new RequiredValidator);
$validator->addStrategy("nom", new StringValidator(50));

if (!$validator->validate($_POST)) {
    header('location: ../public/home.php?error=invalid_data');
    exit();
}

$sanitizedPOST = $validator->sanitize($_POST);

// Contrôle des attributs (exemple : somme max 50)
$attributes = ['attack', 'hp','nom']; // Remplacez par les bons attributs si nécessaire
$total = 0;
foreach ($attributes as $attribute) {
    $total += intval($sanitizedPOST[$attribute] ?? 0);
}

if ($total > 50) {
    header('location: ../public/home.php?error=cheater');
    exit();
}

// Validation des fichiers (image)
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['image'];

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!in_array($fileExtension, $allowedExtensions)) {
        header('location: ../public/home.php?error=invalid_image');
        exit();
    }

    // Téléchargement du fichier
    $uploadDir = '../public/assets/image/';
    $fileName = uniqid() . preg_replace('/[^a-zA-Z0-9\._-]/', '_', basename($file['name']));
    $uploadPath = $uploadDir . $fileName;

    if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
        header('location: ../public/home.php?error=upload_failed');
        exit();
    }

    $sanitizedPOST["filename"] = $fileName;
}

// Création du héros
$myRepository = new HeroRepository;

$hero = $myRepository->save(
    $sanitizedPOST['nom'],
    $sanitizedPOST['filename'],
    $sanitizedPOST['attack'] ?? 20,
    $sanitizedPOST['hp'] ?? 100,
    $sanitizePOST['niveau'] = 1
);


// Stockage en session et cookie

$_SESSION["hero"] = $hero;




// Redirection vers la page de combat
header('location: ../public/fight.php');
exit();

?>
