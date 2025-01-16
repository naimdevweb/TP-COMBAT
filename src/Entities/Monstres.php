<?php
class Monstre extends Entite {
    private $id;
    private $image;
    private $hp;

    
    public function __construct($id, $nom, $hp) {
        parent::__construct($nom);
        $this->id = $id;
        $this->hp = $hp;
        $this->image = $this->genererImageAleatoire();
    }

    public function __toString() {
        ob_start();
        ?>
        <div class="monstre">
            <h3><?= $this->getNom() ?></h3>
            <img src="<?= $this->getImage() ?>" alt="<?= $this->getNom() ?>" class="image"> 
            <p>HP: <?= $this->getHp() ?></p>
        </div>
        <?php
        return ob_get_clean();
    }

    // Génération d'une image aléatoire
    private function genererImageAleatoire() {
        $images = [
            './assets/image/dragon.webp',
            './assets/image/goblin.jpg',
            './assets/image/ogre.jpg',
            './assets/image/sorcier.webp',
            './assets/image/wolf.jpg'
        ];
        return $images[array_rand($images)];
    }

    
    public function getImage() {
        return $this->image;
    }

   
    public function getHp() {
        return $this->hp;
    }

    
    public function setHp($hp) {
        $this->hp = $hp;
        return $this;
    }

    
    public function attaquer() {
        echo $this->nom . " attaque férocement !";
    }
}
?>
