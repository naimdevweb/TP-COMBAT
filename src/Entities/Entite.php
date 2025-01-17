<?php
abstract class Entite {
    protected $nom;
    protected $hp;

    public function __construct($nom, $hp) {
        $this->nom = $nom;
        $this->hp = $hp;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getHp(): int {
        return $this->hp;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setHp($hp) {
        $this->hp = $hp;
    }
}
