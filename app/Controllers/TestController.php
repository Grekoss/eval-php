<?php

namespace OQuiz\Controllers;

use OQuiz\Models\UserModel;
use OQuiz\Models\QuizModel;
use OQuiz\Utils\User;

// UTILISATION DE CETTE CLASS POUR TESTER
class TestController extends CoreController {

    public function test() {
        
        // Affichage de la table souhaité
        echo UserModel::TABLE_NAME.'<br>';

        $userModel = new UserModel();

        $userModel->setFirstName('CedricTest');
        $userModel->setLastName('Name');
        $userModel->setEmail('aa@a.fr');
        $userModel->setPassword('azertyui');

        dump($userModel);

        // Insert à la BDD
        $insertedRows = $userModel->save();

        if ($insertedRows > 0) {
            echo '$userModel inséré<br>';
            // Debug
            dump($userModel);
        }
        else {
            echo 'erreur dans l\'insertion<br>';
            exit;
        }
        

        // Mise à Jour
        $userModel->setFirstName('Nom en MAJ');
        // Debug
        dump($userModel);
        // Update de la BDD
        $updateRows = $userModel->save();
        if($updateRows > 0) {
            echo '$userModel mis à jour<br>';
            //debug
            dump($userModel);
        }
        else {
            echo 'erreur dans la mise à jour <br>';
            exit;
        }

        // Récupération du model pour l'id donnée
        $id = $userModel->getId();

        $lastUserModel = $userModel->find($id);
        echo 'dump de la récupération à partir de l\'id<br>';
        dump($lastUserModel);

        //suppression
        $deleteRows = $userModel->delete();

        if ($deleteRows > 0) {
            echo '$userModel supprimé<br>';
        }
        else {
            echo 'Erreur dans la suppression<br>';
            exit;
        }

        //Je récupère un model pour l'id supprimé
        $lastUserModel = $userModel->find($id);
        echo 'dump de la récupération à partir de l\'id<br>';
        dump($lastUserModel);
    }
}