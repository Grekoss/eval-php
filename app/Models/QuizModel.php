<?php

namespace OQuiz\Models;

use OQuiz\Database;
use PDO;

/*
Règles :
    - 1 table = 1 model
    - 1 champ = 1 propritété
*/
class QuizModel extends CoreModel {

    // Constante attachée à ma classe pas de 'static', c'est implicite
    const TABLE_NAME = 'quizzes';

    private $title;
    private $description;
    private $id_author;

    // Méthodes :
    public static function findAllWithAuthorName() {

        $sql = 'SELECT quizzes.*, users.first_name, users.last_name FROM quizzes INNER JOIN users ON quizzes.id_author = users.id';
        // Utilisation de la classe Database pour se connecter à la DDB
        $pdo = Database::getPDO();
        // Exécution de la requête
        $pdoStatement = $pdo->query($sql);
        // Récupération des résultats en forme de tableau d'objet, on doit préciser le FQCN de la classe
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, static::class);
        // On retourne les résultats
        return $results;
    }

    public static function findQuizzesByAuthor($id_author) {

        $sql = 'SELECT * FROM '.static::TABLE_NAME.' WHERE id_author = :id';
        // Préparation
        $pdoStatement = Database::getPDO()->prepare($sql);
        // Blind
        $pdoStatement->bindValue(':id', $id_author, PDO::PARAM_INT);
        // Execution
        $pdoStatement->execute();
        // Recupération
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, static::class);
        return $results;
    }

    // Getters
    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getIdAuthor() {
        return $this->id_author;
    }

    // Setters
    public function setTitle($title) {
        if (is_string($title) && !empty($title)) {
            $this->title = $title;
        }
    }

    public function setDescription($description) {
        if (is_string($description) && !empty($description)) {
            $this->description = $description;
        }
    }

    public function setIdAuthor($id_author) {
        if (is_numeric($id_author) && !empty($id_author)) {
            $this->id_author = $id_author;
        }
    }
}
