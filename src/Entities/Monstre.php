<?php
class Monstre extends Entite {
    protected $image;
    protected $attack;
    protected $nom;
    protected $niveauMonstre;

    public function __construct($niveauHero) {
        $this->niveauMonstre = $niveauHero;

        
        $numero = random_int(0, 4);
        $this->nom = $this->genererNomAleatoire($numero);
        $this->image = $this->genererImageAleatoire($numero);

        
        $difficultyFactor = $this->niveauMonstre / 10; 

       
        $this->hp = round(rand(100 + ($this->niveauMonstre * 10), 300 + ($this->niveauMonstre * 20)) * $difficultyFactor);
        $this->attack = round(rand(20 + ($this->niveauMonstre * 5), 400 + ($this->niveauMonstre * 5)) * $difficultyFactor);
    }

    private function genererNomAleatoire($numero) {
        $noms = ['Dragon', 'Gobelin', 'Ogre', 'Sorcier', 'Loup Garou'];
        return $noms[$numero];
    }

    private function genererImageAleatoire($numero) {
        $images = [
            './assets/image/dragon.webp',
            './assets/image/goblin.jpg',
            './assets/image/ogre.jpg',
            './assets/image/sorcier.webp',
            './assets/image/wolf.jpg'
        ];
        return $images[$numero];
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getImage() {
        return $this->image;
    }

    public function getHp(): int {
        return $this->hp;
    }

    public function getAttack() {
        return $this->attack;
    }

    public function getNiveauMonstre() {
        return $this->niveauMonstre;
    }
}
