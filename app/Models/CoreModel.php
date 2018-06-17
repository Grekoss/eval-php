<?php

namespace OQuiz\Models;

use OQuiz\Database;
use PDO;

/*
CRUD =>
    Create => insert();
    Read => find();
    Update => update();
    Delete => delete();
*/

// abstract => interdition d'intancier cette class
abstract class CoreModel {
    // Factorisation des propriétés tout comme les gettes et setters => ici c'est seulement ID
    protected $id;

    // Getter
    public function getId() {
        return $this->id;
    }

    // Etant une class abstract, elle ne fait pas le travail mais les héritiés. Elle peut également donner des ordres
    // // TODO: les mettre disponible une fois qui sont créer pour les enfants
    // protected abstract function insert();
    // protected abstract function update();

    // Méthodes permettant de gérer la sauvegarde en BDD
    public function save() {
        // Si on a un id => la ligne existe dans la date alors on la met à jour
        if ($this->id > 0) {
            return $this->update();
        }
        // Sinon la ligne n'existe pas dans la table => on onsère dans la table
        else {
            return $this->insert();
        }
    }

    public function delete() {

        $sql = 'DELETE FROM '.static::TABLE_NAME.' WHERE id = :id';
        // Je prépare
        $pdoStatement = Database::getPDO()->prepare($sql);
        // Je fais mon "bind"
        $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        // J'exécute la requête préparée
        $affectedRows = $pdoStatement->execute();
        return $affectedRows;
    }

    // Méthode permettant de retourner toutes les lignes de la table
    // Déclaration de la méthode en "static" car elle n'est pas liée à l'objet courant ($this) mais à la class en "général"
    public static function findAll() {

        $sql = 'SELECT * FROM '.static::TABLE_NAME;
        // Utilisation de la classe Database pour se connecter à la DDB
        $pdo = Database::getPDO();
        // Exécution de la requête
        $pdoStatement = $pdo->query($sql);
        // Récupération des résultats en forme de tableau d'objet, on doit préciser le FQCN de la classe
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, static::class);
        // On retourne les résultats
        return $results;
    }

    public static function find($id) {

        $sql = 'SELECT * FROM '.static::TABLE_NAME.' WHERE id =:id';
        // Préparation
        $pdoStatement = Database::getPDO()->prepare($sql);
        // Blind
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
        // Execution
        $pdoStatement->execute();
        // Recuperation
        $result = $pdoStatement->fetchObject(static::class);
        return $result;
    }
}
