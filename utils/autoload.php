<?php

spl_autoload_register(function ($className) {
    // Base directory (src)
    $baseDir = __DIR__ . '/../src/';
    
    // Déterminer le répertoire en fonction du suffixe du nom de la classe
    switch (true) {
        case substr($className, -10) === 'Repository':
            $directory = 'Repositories';
            break;
        case substr($className, -7) === 'Manager':
            $directory = 'Managers';
            break;
        case substr($className, -6) === 'Mapper':
            $directory = 'Mappers';
            break;
        case substr($className, -8) === 'Contract':
            $directory = 'Interfaces';
            break;
        case substr($className, -10) === 'Controller':
            $directory = 'Controllers';
            break;
        case substr($className, -7) === 'Service':
            $directory = 'Services';
            break;
        default:
            $directory = 'Entities';
            break;
            case substr($className, -9) === 'Validator':
                $directory = 'Services/Validators';
                break;
                case substr($className, -5) === 'Trait':
                    $directory = 'Traits';
                    break;
    }

    // Construire le chemin complet du fichier
    $file = $baseDir . $directory . '/' . $className . '.php';
    

    // Charge le fichier si trouvé
    if (file_exists($file)) {
        require $file;
    }
});