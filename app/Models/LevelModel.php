<?php

namespace OQuiz\Models;

use OQuiz\Database;
use PDO;

/*
Règles :
    - 1 table = 1 model
    - 1 champ = 1 propritété
*/
class LevelModel extends CoreModel {

    // Constante attachée à ma classe pas de 'static', c'est implicite
    const TABLE_NAME = 'levels';

    private $name;

    // Méthodes :
    

    // Getters
    public function getName() {
        return $this->name;
    }

    // Setters
    public function setName($name) {
        if (is_string($name) && !empty($name)) {
            $this->name = $name;
        }
    }
}
