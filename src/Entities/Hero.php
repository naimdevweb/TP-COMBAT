<?php
class Hero {
    protected int $id;
    protected string $nom;
    protected string $image; 
    protected int $attack; 
    protected int $hp; 
    protected int $niveau; 

    public function __construct($id, $nom, $image, $attack, $hp, $niveau) {
        $this->id = $id;
        $this->nom = $nom;
        $this->image = $image; 
        $this->attack = $attack;  
        $this->hp = $hp;
        $this->niveau = $niveau;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getImage(): string {
        return $this->image;
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

    public function setAttack($attack) {
        $this->attack = $attack;
    }

    public function setHp($hp) {
        $this->hp = $hp;
    }

    public function setNiveau($niveau) {
        $this->niveau = $niveau;
    }

  
}
?>
