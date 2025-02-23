<?php
class HeroRepository {

    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance(); 
    }

    
    public function findHero(int $id): ?Hero {
        $stmt = $this->db->prepare("SELECT * FROM hero WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch();

        if (!$data) {
            return null;
        }

        return new Hero($data['id'], $data['nom'], $data['img'], $data['hp'], $data['attack'], $data['niveau']);
    }

    
    public function save(string $heroName, string $heroImg, int $heroAttack, int $heroHp, int $heroNiveau): Hero {
        $stmt = $this->db->prepare("INSERT INTO hero (nom, img, attack, hp, niveau) VALUES (:nom, :img, :attack, :hp, :niveau)");
        
        $stmt->bindParam(":nom", $heroName, PDO::PARAM_STR);
        $stmt->bindParam(":img", $heroImg, PDO::PARAM_STR);
        $stmt->bindParam(":attack", $heroAttack, PDO::PARAM_INT);
        $stmt->bindParam(":hp", $heroHp, PDO::PARAM_INT);
        $stmt->bindParam(":niveau", $heroNiveau, PDO::PARAM_INT);

        $stmt->execute();

        $id = $this->db->lastInsertId();

        return $this->findHero($id);
    }
    
    public function findAllHeroes() {
        $stmt = $this->db->query('SELECT * FROM hero');
        $heroes = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $heroes[] = new Hero($row['id'], $row['nom'], $row['img'], $row['hp'], $row['attack'], $row['niveau']);
        }
        return $heroes;
    }

    
    public function updateHero(Hero $hero): void {

        $attack = $hero->getAttack();
        $niveau = $hero->getNiveau();
        $hp = $hero->getHp();
        $id = $hero->getId();

        $stmt = $this->db->prepare("UPDATE hero SET attack = :attack, hp = :hp, niveau = :niveau WHERE id = :id");

        $stmt->bindParam(":attack", $attack, PDO::PARAM_INT);
        $stmt->bindParam(":hp", $hp, PDO::PARAM_INT);
        $stmt->bindParam(":niveau", $niveau, PDO::PARAM_INT);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        
        $stmt->execute();
    }


    public function deleteHeroById($heroId) {
        $stmt = $this->db->prepare("DELETE FROM hero WHERE id = :id");
        $stmt->bindParam(":id", $heroId, PDO::PARAM_INT);
        $stmt->execute();
    }


    public function getAllHeroes(): array {
        $stmt = $this->db->prepare("SELECT * FROM hero");  
        $stmt->execute();
        
        $heroes = $stmt->fetchAll(PDO::FETCH_ASSOC);  
    
        $heroObjects = [];
        foreach ($heroes as $heroData) {
            $heroObjects[] = new Hero(
                $heroData['id'],
                $heroData['nom'],
                $heroData['img'],
                $heroData['attack'],
                $heroData['hp'],
                $heroData['niveau']
            ); 
        }
        return $heroObjects; 
    }

    public function findHeroByName(string $name): ?Hero {
        $stmt = $this->db->prepare("SELECT * FROM hero WHERE nom = :nom");
        $stmt->bindParam(":nom", $name, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetch();

        if (!$data) {
            return null;
        }

        return new Hero($data['id'], $data['nom'], $data['img'], $data['hp'], $data['attack'], $data['niveau']);
    }
    
}
?>
