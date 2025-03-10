<?php

class FightsManager {
    private $imgHero;
    private $hpHero;
    private $nomHero;
    private $attackHero;
    private $nomMonstre;
    private $imgMonstre;
    private $hpMonstre;
    private $attackMonstre;
    private $niveauHero;
    private $niveauMonstre;
    private $idHero;

    public function setupFight($hero) {
        if ($hero instanceof Hero) {
            $this->nomHero = $hero->getNom();
            $this->hpHero = $hero->getHp();
            $this->imgHero = $hero->getImage();
            $this->attackHero = $hero->getAttack();
            $this->niveauHero = $hero->getNiveau();
            $this->idHero = $hero->getId();
        } else {
            header('location: ./home.php');
            exit();
        }
        
        // Générer un monstre en fonction du niveau du héros
        $monstre = new Monstre($this->niveauHero);
        $this->nomMonstre = $monstre->getNom();
        $this->imgMonstre = $monstre->getImage();
        $this->hpMonstre = $monstre->getHp();
        $this->attackMonstre = $monstre->getAttack();
        $this->niveauMonstre = $monstre->getNiveauMonstre();
    }

    

    public function renderFightPage() {
        ob_start();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Combat - Héros vs Monstre</title>
            <link rel="stylesheet" href="./assets/css/style.css">
            <script src="./assets/script/script.js" defer></script>
        </head>
        <body class="bodycombat">
        <audio id="backgroundMusic" src="../../public/assets/epic-music-fight-battle-airforce-navy-combat-background-intro-theme-259695.mp3"></audio>
        
        <div class="game-container">
            <div class="battlefield">
                <!-- Héros -->
                <div class="character hero">
                    <h2><?= htmlspecialchars($this->nomHero) ?></h2>
                    <img src="./assets/image/<?= htmlspecialchars($this->imgHero) ?>" alt="" class="image hero">
                    <div class="health-bar">
                        <div class="health" id="hero-health" style="width: <?= $this->hpHero ?>%;"></div>
                    </div>
                    <p>PV : <span id="hero-hp"><?= htmlspecialchars($this->hpHero) ?></span></p>
                    <p>Attaque : <span id="attack"><?= htmlspecialchars($this->attackHero) ?></span></p>
                    <p>Niveau : <span id="hero-level"><?= htmlspecialchars($this->niveauHero) ?></span></p>
                    <span id="hero-id" style="display: none;"><?= htmlspecialchars($this->idHero) ?></span>
                </div>

                <div class="vs-text">VS</div>

                <!-- Monstre -->
                <div class="character monster">
                    <h2><?= htmlspecialchars($this->nomMonstre) ?></h2>
                    <img src="<?= htmlspecialchars($this->imgMonstre) ?>" alt="<?= htmlspecialchars($this->nomMonstre) ?>" class="image monster">
                    <div class="health-bar">
                        <div class="health" id="monster-health" style="width: <?= $this->hpMonstre ?>%;"></div>
                    </div>
                    <p>PV : <span id="monster-hp"><?= htmlspecialchars($this->hpMonstre) ?></span></p>
                    <p>Attaque : <span id="monstre-attack"><?= htmlspecialchars($this->attackMonstre) ?></span></p>
                    <p>Niveau : <span id="monster-level"><?= htmlspecialchars($this->niveauMonstre) ?></span></p>
                </div>
            </div>
            
            <div class="controls">
                <button class="attack" id="btn-hero" class="attack-button">Héros Attaque</button>
                <button id="btn-restart" style="display: none;" onclick="restartGame()">Recommencer</button>
                <button id="btn-quit" style="display: none;" onclick="quitGame()">Quitter</button> 
                <button id="btn-restaure" style="display: none;" >Restaurer</button> 
            </div>

            <div class="attack-messages" id="attack-messages"></div>

            <form id="update-stats-form" action="../process/process_fight.php" method="POST" style="display: none;">
                <input type="hidden" name="heroId" value="<?= $this->idHero  ?>" id="hero-id">
                <input type="hidden" name="newLevel" value="<?= $this->niveauHero + 1 ?>" id="new-level">
                <input type="hidden" name="newHp" value="<?= $this->hpHero + 20 ?>" id="new-hp">
                <input type="hidden" name="newAttack" value="<?= $this->attackHero + 5 ?>" id="new-attack">
            </form>
        </div>

        </body>
        </html>
        <?php
        return ob_get_clean();
    }
}
?>