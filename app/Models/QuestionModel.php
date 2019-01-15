<?php

namespace OQuiz\Models;

use OQuiz\Database;
use PDO;

/*
Règles :
    - 1 table = 1 model
    - 1 champ = 1 propritété
*/
class QuestionModel extends CoreModel {

    // Constante attachée à ma classe pas de 'static', c'est implicite
    const TABLE_NAME = 'questions';

    private $id_quiz;
    private $question;
    private $prop1;
    private $prop2;
    private $prop3;
    private $prop4;
    private $id_level;
    private $anecdote;
    private $wiki;

    // Méthodes :

    public static function findQuestionsByIdQuizWithLevel($id_quiz) {

        $sql = 'SELECT '.static::TABLE_NAME.'.*, levels.name FROM questions INNER JOIN levels ON '.static::TABLE_NAME.'.id_level = levels.id WHERE '.static::TABLE_NAME.'.id_quiz = :id';
        // Préparation
        $pdoStatement = Database::getPDO()->prepare($sql);
        // Blind
        $pdoStatement->bindValue(':id', $id_quiz, PDO::PARAM_INT);
        // Execution
        $pdoStatement->execute();
        // Récupération
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, static::class);
        return $results;
    }

    // Getters
    public function getIdQuiz() {
        return $this->id_quiz;
    }

    public function getQuestion() {
        return $this->question;
    }

    public function getProp1() {
        return $this->prop1;
    }

    public function getProp2() {
        return $this->prop2;
    }

    public function getProp3() {
        return $this->prop3;
    }

    public function getProp4() {
        return $this->prop4;
    }

    public function getIdLevel() {
        return $this->id_level;
    }

    public function getAnecdote() {
        return $this->anecdote;
    }

    public function getWiki() {
        return $this->wiki;
    }

    // Setters
    public function setIdQuiz($id_quiz) {
        if (is_numeric($id_quiz) && !empty($id_quiz)) {
            $this->id_quiz = $id_quiz;
        }
    }

    public function setQuestion($question) {
        if (is_string($question) && !empty($question)) {
            $this->question = $question;
        }
    }

    public function setProp1($prop1) {
        if (is_string($prop1) && !empty($prop1)) {
            $this->prop1 = $prop1;
        }
    }

    public function setProp2($prop2) {
        if (is_string($prop2) && !empty($prop2)) {
            $this->prop2 = $prop2;
        }
    }

    public function setProp3($prop3) {
        if (is_string($prop3) && !empty($prop3)) {
            $this->prop3 = $prop3;
        }
    }

    public function setProp4($prop4) {
        if (is_string($prop4) && !empty($prop4)) {
            $this->prop4 = $prop4;
        }
    }

    public function setIdLevel($id_level) {
        if (is_numeric($id_level) && !empty($id_level)) {
            $this->id_level = $id_level;
        }
    }

    public function setAnecdote($anecdote) {
        if (is_string($anecdote) && !empty($prop4)) {
            $this->anecdote = $anecdote;
        }
    }

    public function setWiki($wiki) {
        if (is_string($wiki) && !empty($wiki)) {
            $this->wiki = $wiki;
        }
    }
}
