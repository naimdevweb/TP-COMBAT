<?php
class Hero extends Entite {
    protected $id;
    protected $image; 
    protected $attack; 
    protected $niveau; 

    public function __construct($id, $nom, $image, $attack, $hp, $niveau) {
        parent::__construct($nom, $hp);
        $this->id = $id;
        $this->image = $image; 
        $this->attack = $attack;  
        $this->niveau = $niveau;
    }

    public function __toString() {
        ob_start();
        ?>
        <div class="hero">
            <h3><?= $this->getNom() ?></h3>
            <img src="<?= $this->getImage() ?>" alt="<?= $this->getNom() ?>" class="image"> 
            <p>HP: <?= $this->getHp() ?></p>
        </div>
        <?php
        return ob_get_clean();
    }

    public function getImage() {
        return $this->image;
    }

    public function getId() {
        return $this->id;
    }

    public function getHp(): int {
        return $this->hp;
    }

    public function getAttack(): int {
        return $this->attack;
    }

    public function getNiveau(): int {
        return $this->niveau;
    }

    public function setNiveau(int $niveau) {
        $this->niveau = $niveau;
    }

    public function setHp($hp) {
        $this->hp = $hp;
    }

    public function monterNiveau() {
        $this->niveau++;
        $this->hp += 10;  // Augmenter les points de vie à chaque niveau
        $this->attack += 5;  // Augmenter l'attaque à chaque niveau

        // Mise à jour de la base de données
        $heroRepo = new HeroRepository();
        $heroRepo->updateHero($this);
    }
}
