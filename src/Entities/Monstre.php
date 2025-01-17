<?php
class Monstre extends Entite {
    protected $image;
    protected $attack;
    protected $nom;
    protected $niveauMonstre;

    public function __construct($niveauHero) {
        $this->niveauMonstre = $niveauHero;

        // Définir le monstre aléatoirement
        $numero = random_int(0, 4);
        $this->nom = $this->genererNomAleatoire($numero);
        $this->image = $this->genererImageAleatoire($numero);

        // Ajuster les caractéristiques en fonction du niveau du héros
        $this->hp = rand(100 + $this->niveauMonstre * 10, 500 + $this->niveauMonstre * 20);
        $this->attack = rand(20 + $this->niveauMonstre * 2, 100 + $this->niveauMonstre * 5);
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
