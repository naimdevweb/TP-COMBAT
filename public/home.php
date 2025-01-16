<?php
// Inclure le header
include '../public/components/header.php';
?>

<main>
    <h2>Bienvenue dans Combat</h2>
    <p>Préparez-vous à l'affrontement ultime entre héros légendaires.</p>
    
    <form action="../process/create-hero-process.php" method="POST">
        <label for="nom">Nom du héros:</label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="image">Image du héros :</label>
<input type="file" id="image" name="image" accept="image/*" required><br><br>


        <label for="hp">Attack du héros:</label>
        <input type="number" id="hp" name="hp" required><br><br>

        <label for="attack">HP du héros:</label>
        <input type="number" id="attack" name="attack" required><br><br>

        <button type="submit">Créer le héros</button>
        <button type="submit">Voir tout les héros</button>
    </form>
</main>


<?php
include '../public/components/footer.php';
?>
