<?php
class Hero {
    protected $id;
    protected $nom;
    protected $image; 
    protected $attack; 
    protected $hp; 
    protected $niveau; 

    public function __construct($id, $nom, $image, $attack, $hp, $niveau) {
        $this->id = $id;
        $this->nom = $nom;
        $this->image = $image; 
        $this->attack = $attack;  
        $this->hp = $hp;
        $this->niveau = $niveau;
    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getImage() {
        return $this->image;
    }

    public function getHp() {
        return $this->hp;
    }

    public function getAttack() {
        return $this->attack;
    }

    public function getNiveau() {
        return $this->niveau;
    }

    public function setAttack($attack) {
        $this->attack = $attack;
    }

    public function setHp($hp) {
        $this->hp = $hp;
    }

    public function setNiveau($niveau) {
        $this->niveau = $niveau;
    }

    public function saveHero(Hero $hero) {
        $heroRepo = new HeroRepository();
        if ($this->id) {
            // Si le héros a déjà un ID, on le met à jour
            $heroRepo->updateHero($this);
        } else {
            // Si c'est un nouveau héros, on l'insère
            $heroRepo->save($this->nom, $this->image, $this->attack, $this->hp, $this->niveau);
        }
    }
}
?>
