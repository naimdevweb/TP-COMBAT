<?php


require_once '../utils/autoload.php';

class SecurityService {

    // Méthode de validation et de création du héros
    public function securite() {

        // Initialiser les erreurs et les données
        $errors = [];
        $nom = $image = $hp = '';

        // Vérifier si le formulaire a été soumis via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Récupérer et sécuriser les données envoyées via POST
            $nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';
            $image = isset($_POST['image']) ? trim($_POST['image']) : '';
            $hp = isset($_POST['hp']) ? (int)$_POST['hp'] : 0;

            // Validation des données
            if (empty($nom)) {
                $errors[] = "Le nom du héros est requis.";
            }

            if (empty($image)) {
                $errors[] = "L'image du héros est requise.";
            }

            if ($hp <= 0) {
                $errors[] = "Les HP du héros doivent être un nombre positif.";
            }

           
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo "<p style='color: red;'>$error</p>";
                }
                return; 
            }

           
            // try {
            //     $hero = new Hero(null, $nom, $image, $hp); // ID sera généré automatiquement lors de l'enregistrement

            //     // Sauvegarder le héros dans la base de données
            //     $heroRepository = new HeroRepository();
            //     $heroRepository->save($nom, $image);

            //     // Redirection après la création réussie
            //     header("Location: ../public/test.php");
            //     exit();

            // } catch (Exception $e) {
            //     // En cas d'erreur lors de l'enregistrement, afficher un message d'erreur
            //     echo "<p style='color: red;'>Erreur lors de la création du héros: " . $e->getMessage() . "</p>";
            // }
        }
    }
}

?>
