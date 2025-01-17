<?php

class HeroRepository {
    private PDO $db;

    // Constructeur pour obtenir l'instance de la base de données
    public function __construct() {
        $this->db = Database::getInstance(); 
    }

    // Méthode pour récupérer un héros par son ID
    public function findHero(int $id): ?Hero {
        // Préparer la requête pour rechercher le héros par son ID
        $stmt = $this->db->prepare("SELECT * FROM hero WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        // Récupérer les données du héros
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si aucune donnée n'est trouvée, retourner null
        if (!$data) {
            return null;
        }

        // Mapper les données récupérées dans un objet Hero
        return HeroMapper::mapToObject($data);
    }

    // Méthode pour enregistrer un nouveau héros
    public function save(string $heroName, string $heroImg, int $heroAttack, int $heroHp, int $heroNiveau = 1): Hero {
        // Préparer la requête d'insertion
        $stmt = $this->db->prepare("INSERT INTO hero (nom, img, attack, hp, niveau) VALUES (:nom, :img, :attack, :hp, :niveau)");

        // Lier les paramètres
        $stmt->bindParam(":nom", $heroName, PDO::PARAM_STR);
        $stmt->bindParam(":img", $heroImg, PDO::PARAM_STR);
        $stmt->bindParam(":attack", $heroAttack, PDO::PARAM_INT);
        $stmt->bindParam(":hp", $heroHp, PDO::PARAM_INT);
        $stmt->bindParam(":niveau", $heroNiveau, PDO::PARAM_INT);

        // Exécuter la requête
        $stmt->execute();

        // Récupérer l'ID du dernier héros inséré
        $id = $this->db->lastInsertId();

        // Retourner le héros inséré
        return $this->findHero((int) $id);
    }

    // Méthode pour mettre à jour le niveau d'un héros
    public function updateHero(Hero $hero): bool {
        // Préparer la requête de mise à jour
        $stmt = $this->db->prepare("UPDATE hero SET niveau = :niveau WHERE id = :id");

        // Lier les paramètres
        $stmt->bindParam(':niveau', $hero->getNiveau(), PDO::PARAM_INT);  // Utiliser la méthode getNiveau pour obtenir le niveau du héros
        $stmt->bindParam(':id', $hero->getId(), PDO::PARAM_INT);  // Utiliser la méthode getId pour obtenir l'ID du héros

        // Exécuter la requête et retourner si la mise à jour a réussi
        return $stmt->execute();
    }
}

?>
