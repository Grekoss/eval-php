<?php

namespace OQuiz;

use PDO;

class Database {
    private $dbh;
    private static $_instance;

    private function __construct() {
        //Récupération de la configuration
        $localDbConfig = parse_ini_file(__DIR__.'/config.conf');

        try {
            $this->dbh = new PDO(
                "mysql:host={$localDbConfig['DB_HOST']};dbname={$localDbConfig['DB_NAME']};charset=utf8",
                $localDbConfig['DB_USERNAME'],
                $localDbConfig['DB_PASSWORD'],
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)     // Affiche les erreurs SQL à l'écran
            );
        }
        catch(\Exception $exception) {
            die('Erreur de connexion...' . $exception->getMessage());
        }
    }
    // L'unique méthode que l'on a besoin d'utiliser
    public static function getPDO() {
        // Si elle n'est pas intancié alors on la crée
        if (empty(self::$_instance)) {
            self::$_instance = new Database();
        }
        return self::$_instance->dbh;
    }
}
