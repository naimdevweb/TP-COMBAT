<?php
class Hero extends Entite {
    protected $id;
    protected $image; 
    protected $attack; 

    public function __construct($id, $nom, $image,$attack,$hp) {
        parent::__construct($nom, $hp);
        $this->id = $id;
        $this->image = $image; 
        $this->attack = $attack;  
    }

    public function __toString() {
        ob_start();
        ?>
        <div class="hero">
            <h3><?= $this->getNom() ?></h3>
            <img src="<?= $this->getImage() ?>" alt="<?= $this->getNom() ?>" class="image"> 
            <p>HP: <?= $this->gethp() ?></p>
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

    public function setId($id) {
        $this->id = $id;
    }

    public function attaquer() {
        echo $this->nom . " attaque avec une épée !";
    }

    public function getHp() {
        return $this->hp;
    }

       
        public function setImage($image)
        {
                $this->image = $image;

                return $this;
        }

        /**
         * Get the value of attack
         */ 
        public function getAttack()
        {
                return $this->attack;
        }

        /**
         * Set the value of attack
         *
         * @return  self
         */ 
        public function setAttack($attack)
        {
                $this->attack = $attack;

                return $this;
        }
}
