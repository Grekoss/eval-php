<?php

namespace OQuiz;

use PDO;

class Database {
    private $dbh;
    private static $_instance;

    private function __construct() {
        // Retrieving the configuration
        $localDbConfig = parse_ini_file(__DIR__.'/config.conf');

        try {
            $this->dbh = new PDO(
                "mysql:host={$localDbConfig['DB_HOST']};dbname={$localDbConfig['DB_NAME']};charset=utf8",
                $localDbConfig['DB_USERNAME'],
                $localDbConfig['DB_PASSWORD'],
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)     // Show the errors SQL
            );
        }
        catch(\Exception $exception) {
            die('Erreur de connexion...' . $exception->getMessage());
        }
    }
    // The only method that one needs to use
    public static function getPDO() {
        // If it is not instantiated then we create it
        if (empty(self::$_instance)) {
            self::$_instance = new Database();
        }
        return self::$_instance->dbh;
    }
}
