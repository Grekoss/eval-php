<?php

namespace OQuiz\Models;

use OQuiz\Database;
use PDO;

/*
Règles :
    - 1 table = 1 model
    - 1 champ = 1 propritété
*/
class UserModel extends CoreModel {

    // Constante attachée à ma classe pas de 'static', c'est implicite
    const TABLE_NAME = 'users';

    private $first_name;
    private $last_name;
    private $email;
    private $password;

    // Méthodes :

    protected function insert() {

        $sql = 'INSERT INTO '.self::TABLE_NAME.' (`first_name`, `last_name`, `email`, `password`) VALUES (
            :firstName,
            :lastName,
            :email,
            :password)';
        // Préparation
        $pdoStatement = Database::getPDO()->prepare($sql);
        // Binds
        $pdoStatement->bindValue(':firstName', $this->first_name, PDO::PARAM_STR);
        $pdoStatement->bindValue(':lastName', $this->last_name, PDO::PARAM_STR);
        $pdoStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $pdoStatement->bindValue(':password', $this->password, PDO::PARAM_STR);
        // Exécutation
        $affectedRows = $pdoStatement->execute();
        // On récupère l'id auto-incrémenté et on l'affecte à la propriété id
        $this->id = Database::getPDO()->lastInsertId();
        return $affectedRows;
    }

    protected function update() {

        $sql = 'UPDATE '.self::TABLE_NAME.' SET `first_name` = :firstName, `last_name` = :lastName, `email` = :email, `password` = :password WHERE id = :id';
        // Préparation
        $pdoStatement = Database::getPDO()->prepare($sql);
        //Binds
        $pdoStatement->bindValue(':firstName', $this->first_name, PDO::PARAM_STR);
        $pdoStatement->bindValue(':lastName', $this->last_name, PDO::PARAM_STR);
        $pdoStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
        $pdoStatement->bindValue(':password', $this->password, PDO::PARAM_STR);
        $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        // Exécution
        $affectedRows = $pdoStatement->execute();
        return $affectedRows;
    }

    public static function findByEmail($email) {

        $sql = 'SELECT * FROM '.self::TABLE_NAME.' WHERE email = :email LIMIT 1';
        // Préparation
        $pdoStatement = Database::getPDO()->prepare($sql);
        // Bind
        $pdoStatement->bindValue(':email', $email, PDO::PARAM_STR);
        // Exécutation
        $pdoStatement->execute();
        // On n'a qu'un résultat => fetchObject
        $result = $pdoStatement->fetchObject(self::class);
        return $result;
    }

    // Getters
    public function getFirstName() {
        return $this->first_name;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    // Setters
    public function setFirstName($first_name) {
        if (is_string($first_name) && !empty($first_name)) {
            $this->first_name = $first_name;
        }
    }

    public function setLastName($last_name) {
        if (is_string($last_name) && !empty($last_name)) {
            $this->last_name = $last_name;
        }
    }

    public function setEmail($email) {
        if (is_string($email) && !empty($email)) {
            $this->email = $email;
        }
    }

    public function setPassword($password) {
        if (is_string($password) && !empty($password)) {
            $this->password = $password;
        }
    }
}
