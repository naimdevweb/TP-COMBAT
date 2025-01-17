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
    private $idHero;  // Ajout de la propriété pour l'ID du héros

    public function attributs() {
        if (isset($_SESSION['hero'])) {
            $monHero = $_SESSION['hero'];

            if ($monHero instanceof Hero) {
                $this->nomHero = $monHero->getNom();
                $this->hpHero = $monHero->getHp();
                $this->imgHero = $monHero->getImage();
                $this->attackHero = $monHero->getAttack();
                $this->niveauHero = $monHero->getNiveau();
                $this->idHero = $monHero->getId();  // Récupération de l'ID du héros
            } else {
                header('location: ./home.php');
                exit();
            }
        }

        // Créer un monstre en fonction du niveau du héros
        $monstre = new Monstre($this->niveauHero);  // Passer le niveau du héros
        $this->nomMonstre = $monstre->getNom(); 
        $this->imgMonstre = $monstre->getImage(); 
        $this->hpMonstre = $monstre->getHp(); 
        $this->attackMonstre = $monstre->getAttack(); 
        $this->niveauMonstre = $monstre->getNiveauMonstre();
    }

    public function displayfight() {
        ob_start();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Combat - Héros vs Monstre</title>
            <link rel="stylesheet" href="./assets/css/style.css">
            <script src="./assets/script/script.js" defer ></script>
        </head>
        <body>
        
        <div class="game-container">
        
            <div class="battlefield">
                <!-- Héros -->
                <div class="character hero">
                    <h2><?= htmlspecialchars($this->nomHero) ?></h2>
                    <img src="./assets/image/<?= htmlspecialchars($this->imgHero) ?>" alt="" class="image">
                    <div class="health-bar">
                        <div class="health" id="hero-health" style="width: <?= $this->hpHero ?>%;"></div>
                    </div>
                    <p>PV : <span id="hero-hp"><?= htmlspecialchars($this->hpHero) ?></span></p>
                    <p>Attaque : <span id="attack"><?= htmlspecialchars($this->attackHero) ?></span></p>
                    <p>Niveau : <span id="hero-level"><?= htmlspecialchars($this->niveauHero) ?></span></p>

                    <!-- Ajout des ID et stats cachées -->
                    <span id="hero-id" style="display:none;"><?= htmlspecialchars($this->idHero) ?></span> 
                    <span id="hero-level" style="display:none;"><?= htmlspecialchars($this->niveauHero) ?></span>
                    <span id="hero-hp" style="display:none;"><?= htmlspecialchars($this->hpHero) ?></span>
                    <span id="hero-attack-hidden" style="display:none;"><?= htmlspecialchars($this->attackHero) ?></span>
                </div>

                <div>VS
                <p id="attack-messages" class="attack-messages"></p>
                </div>

                <!-- Monstre -->
                <div class="character monster">
                    <h2><?= htmlspecialchars($this->nomMonstre) ?></h2>
                    <img src="<?= htmlspecialchars($this->imgMonstre) ?>" alt="<?= htmlspecialchars($this->nomMonstre) ?>" class="image">
                    <div class="health-bar">
                        <div class="health" id="monster-health" style="width: <?= $this->hpMonstre ?>%;"></div>
                    </div>
                    <p>PV : <span id="monster-hp"><?= htmlspecialchars($this->hpMonstre) ?></span></p>
                    <p>Attaque : <span id="monstre-attack"><?= htmlspecialchars($this->attackMonstre) ?></span></p>
                    <p>Niveau : <span id="monster-level"><?= htmlspecialchars($this->niveauMonstre) ?></span></p>
                </div>
            </div>
        
            <!-- Zone de contrôle -->
            <div class="controls">
                <button id="btn-hero" class="attack-button">Héros Attaque</button>
                <button id="btn-restart" style="display: none;">Recommencer</button> 
            </div>

        </div>

        </body>
        </html>
        <?php
        return ob_get_clean();
    }
}
