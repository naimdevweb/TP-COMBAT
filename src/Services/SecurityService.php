<?php
require_once '../utils/autoload.php';

class SecurityService {
    public function securite() {
        $errors = [];
        $nom = $image = $hp = $attack = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer et sécuriser les données
            $nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';
            $image = isset($_POST['image']) ? trim($_POST['image']) : '';
            $hp = isset($_POST['hp']) ? (int)$_POST['hp'] : 0;
            $attack = isset($_POST['attack']) ? (int)$_POST['attack'] : 0;

            if (empty($nom)) {
                $errors[] = "Le nom du héros est requis.";
            }

            if (empty($image)) {
                $errors[] = "L'image du héros est requise.";
            }

            if ($hp <= 0) {
                $errors[] = "Les HP du héros doivent être un nombre positif.";
            }

            if ($attack <= 0) {
                $errors[] = "L'attaque du héros doit être un nombre positif.";
            }

            // Vérifier si le nom existe déjà dans la base de données
            $heroRepository = new HeroRepository();
            if ($heroRepository->isNameTaken($nom)) {
                $errors[] = "Un héros avec ce nom existe déjà.";
            }

            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo "<p style='color: red;'>$error</p>";
                }
                return;
            }

            // Si pas d'erreurs, créer le héros
            $hero = new Hero(null, $nom, $image);
            $hero->setHp($hp);
            $hero->setAttack($attack);

            $heroRepository->create($hero);

            echo "<p style='color: green;'>Héros créé avec succès !</p>";
        }
    }
}
