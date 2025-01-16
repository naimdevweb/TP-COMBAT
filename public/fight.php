<?php
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combat Héros vs Monstre</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="game-container">
        <!-- Zone de combat -->
        <div class="battlefield">
            <!-- Héros -->
            <div class="character hero">
                <h2>Héros : <span id="hero-name">Éclair du Tonnerre</span></h2>
                <img id="hero-image" src="./assets/images/hero.png" alt="Héros">
                <div class="health-bar">
                    <div id="hero-health" class="health" style="width: 100%;"></div>
                </div>
                <p>PV : <span id="hero-hp">100</span></p>
            </div>

            <!-- Monstre -->
            <div class="character monster">
                <h2>Monstre : <span id="monster-name">Dragon de Feu</span></h2>
                <img id="monster-image" src="./assets/images/dragon.png" alt="Monstre">
                <div class="health-bar">
                    <div id="monster-health" class="health" style="width: 100%;"></div>
                </div>
                <p>PV : <span id="monster-hp">100</span></p>
            </div>
        </div>

        <!-- Zone de commande -->
        <div class="controls">
            <button onclick="attack('hero')">Héros Attaque</button>
            <button onclick="attack('monster')">Monstre Attaque</button>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
