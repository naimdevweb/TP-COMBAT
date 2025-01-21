<?php
// require_once '../utils/autoload.php';

// class SecurityService {
//     public function securite() {
//         $errors = [];
//         $nom = $image = $hp = $attack = '';

//         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//             // Récupérer et sécuriser les données
//             $nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';
//             $image = isset($_POST['image']) ? trim($_POST['image']) : '';
//             $hp = isset($_POST['hp']) ? (int)$_POST['hp'] : 0;
//             $attack = isset($_POST['attack']) ? (int)$_POST['attack'] : 0;

//             if (empty($nom)) {
//                 $errors[] = "Le nom du héros est requis.";
//             }

//             if (empty($image)) {
//                 $errors[] = "L'image du héros est requise.";
//             }

//             if ($hp <= 0) {
//                 $errors[] = "Les HP du héros doivent être un nombre positif.";
//             }

//             if ($attack <= 0) {
//                 $errors[] = "L'attaque du héros doit être un nombre positif.";
//             }

//             // Vérifier si le nom existe déjà dans la base de données
//             $heroRepository = new HeroRepository();
//             if ($heroRepository->isNameTaken($nom)) {
//                 $errors[] = "Un héros avec ce nom existe déjà.";
//             }

//             if (!empty($errors)) {
//                 foreach ($errors as $error) {
//                     echo "<p style='color: red;'>$error</p>";
//                 }
//                 return;
//             }

//             // Si pas d'erreurs, créer le héros
//             $hero = new Hero(null, $nom, $image);
//             $hero->setHp($hp);
//             $hero->setAttack($attack);

//             $heroRepository->create($hero);

//             echo "<p style='color: green;'>Héros créé avec succès !</p>";
//         }
//     }
// }










class validatorService {

    // On crée un array vide qstrategies qu'on remplira en fonction des validations qu'on fera
    private $strategies = [];



    /**
     * @param string $field name of the field to validate
     * @param ValidationContract $strategy validator to use on the field !!! Has to be a created instance !!! ex : new RequiredValidator()
     * Puts the strategy into the $strategies array
     */
    public function addStrategy(string $field, ValidationContract $strategy) {

        // If there's already a strategy on the field given, puts the given strategy into the subarray
        if (!isset($this->strategies[$field])) {
            $this->strategies[$field] = [];
        }
        $this->strategies[$field][] = $strategy;
    }



    /**
     * @param array $data array of data given, usually from a form. For example a $_GET or a $_POST.
     */
    public function validate(array $data): bool {

        

        // On all the fields in $strategies, each once having for a value an array of multiple $strategies
        foreach($this->strategies as $field => $strategies){

            // If the field doesn't exist in the data given, return false
            if (!isset($data[$field])) {
                
                return false;
            }


            // For each strategy in this field
            foreach ($strategies as $strategy) {
                // If the validate method done with the strategy returns false, Return false
                if (!$strategy->validate($data[$field])) {
                    return false;
                }

            }
        }
        // If there was no errors, return true
        $this->strategies = [];
        return true;

    }

    /**
     * @param array $data array of data given, usually from a form. For example a $_GET or a $_POST.
     * @return array data with spaces trimmed and special chars converted
     */
    public function sanitize(array $data):array {
        $sanitizedData = [];

        foreach ($data as $field => $value) {
            $sanitizedData[$field] = htmlspecialchars(trim($value));
        }
        return $sanitizedData;
    }

    /**
     * @param string $method Form method
     * Checks if the form was sent with the method given 
     * @return bool
     */
    public function checkMethods(string $method):bool {
        if ($_SERVER['REQUEST_METHOD'] !== $method) {
            header('location: ../index.php');
            return false;
        }
        return true;
    }



}



