<?php
class HeroRepository {

    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance(); // Connexion à la base de données
    }

    // Méthode pour récupérer un héros par son ID
    public function findHero(int $id): ?Hero {
        $stmt = $this->db->prepare("SELECT * FROM hero WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch();

        if (!$data) {
            return null;
        }

        // Mapper les données de la base vers un objet Hero
        return HeroMapper::mapToObject($data);
    }

    // Méthode pour sauvegarder un nouveau héros dans la base de données
    public function save(string $heroName, string $heroImg, int $heroAttack, int $heroHp, int $heroNiveau): Hero {
        $stmt = $this->db->prepare("INSERT INTO hero (nom, img, attack, hp, niveau) VALUES (:nom, :img, :attack, :hp, :niveau)");
        
        $stmt->bindParam(":nom", $heroName, PDO::PARAM_STR);
        $stmt->bindParam(":img", $heroImg, PDO::PARAM_STR);
        $stmt->bindParam(":attack", $heroAttack, PDO::PARAM_INT);
        $stmt->bindParam(":hp", $heroHp, PDO::PARAM_INT);
        $stmt->bindParam(":niveau", $heroNiveau, PDO::PARAM_INT);

        $stmt->execute();

        // Récupérer l'ID du dernier héros inséré
        $id = $this->db->lastInsertId();

        // Retourner le héros inséré
        return $this->findHero($id);
    }

    // Méthode pour mettre à jour les informations d'un héros dans la base de données
    public function updateHero(Hero $hero): void {
        $stmt = $this->db->prepare("UPDATE hero SET attack = :attack, hp = :hp, niveau = :niveau WHERE id = :id");

        $stmt->bindParam(":attack", $hero->getAttack(), PDO::PARAM_INT);
        $stmt->bindParam(":hp", $hero->getHp(), PDO::PARAM_INT);
        $stmt->bindParam(":niveau", $hero->getNiveau(), PDO::PARAM_INT);
        $stmt->bindParam(":id", $hero->getId(), PDO::PARAM_INT);
        
        $stmt->execute();
    }
}
?>
