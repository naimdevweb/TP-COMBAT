<?php
// Inclure le header et la sécurité
include '../public/components/header.php';
require_once '../utils/autoload.php';

session_start();
$securityService = new SecurityService();
$securityService->securite();

?>

<main>
    <h2>Bienvenue dans Combat</h2>
    <p>Préparez-vous à l'affrontement ultime entre héros légendaires.</p>
    


    <form action="../process/create-hero-process.php" method="POST">
        <label for="nom">Nom du héros:</label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="image">Image du héros :</label>
        <input type="file" id="image" name="image" accept="image/*" required><br><br>

        <label for="hp">HP du héros:</label>
        <input type="number" id="hp" name="hp" required><br><br>

        <label for="attack">Attaque du héros:</label>
        <input type="number" id="attack" name="attack" required><br><br>

        <button type="submit">Créer le héros</button>
        <a href="./list-heroes.php">Voir tous les héros</a>
    </form>
</main>

<?php
include '../public/components/footer.php';
?>
