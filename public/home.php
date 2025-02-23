<?php
// Inclure le header et la sécurité
include '../public/components/header.php';
require_once '../utils/autoload.php';

session_start();




?>

<main>
    <body class="homebody">
        
    
    <h2>Bienvenue dans Combat</h2>
    <p>Préparez-vous à l'affrontement ultime entre héros légendaires.</p>
    <?php
   
    if (isset($_GET['error']) && $_GET['error'] == 'invalid_image') {
       
        $message = isset($_GET['message']) ? "": 'Une erreur est survenue : veuillez choisir une image valide.';
        
        
        echo "<div class='error-message'>$message</div>";
    }



if (isset($_GET['nohero'])) {
    $error = htmlspecialchars($_GET['nohero']); 
    echo "<div class='error-message'>$error</div>";
}


?>



    <form action="../process/create-hero-process.php" method="POST" enctype="multipart/form-data">
        <label for="nom">Nom du héros:</label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="image">Image du héros :</label>
        <input type="file" id="image" name="image"   required><br><br>

       

        <button type="submit">Créer le héros</button>
        <a  class="voirhero" href="./listehero.php">Voir tous les héros</a>
    </form>
</main>
</body>

<?php
include '../public/components/footer.php';
?>
