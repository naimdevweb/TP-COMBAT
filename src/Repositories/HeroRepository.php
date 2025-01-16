<?php
class HeroRepository {

private PDO $db;

public function __construct() {
    $this->db = Database::getInstance(); 
}

// Méthode pour récupérer les héros par leur nom
public function findHero(string $id): ?Hero {

    $stmt = $this->db->prepare("SELECT * FROM hero WHERE id = :id");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();

  
    $data = $stmt->fetch();

    
    if (!$data) {
        return null;
    }


    

    return HeroMapper::mapToObject($data);
}


public function save($heroName, $heroImg,int $heroAttack,int $heroHp): Hero {

    
    $stmt = $this->db->prepare("INSERT INTO hero (nom, img, attack ,hp) VALUES (:nom, :img, :attack, :hp)");

    
    $stmt->bindParam(":nom", $heroName, PDO::PARAM_STR);
    $stmt->bindParam(":img", $heroImg, PDO::PARAM_STR);
    $stmt->bindParam(":attack", $heroAttack, PDO::PARAM_INT);
    $stmt->bindParam(":hp", $heroHp, PDO::PARAM_INT);

    
    $stmt->execute();

    // Get id

    $id = $this->db->lastInsertId();

    // Récupérer le héros créé
    $heroInstance = self::findHero($id);
    

    // Récupérer l'ID du héros inséré et l'affecter à l'objet Hero
    return $heroInstance;
}
}
