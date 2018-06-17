<?php

namespace OQuiz\Controllers;

use OQuiz\Models\QuizModel;

class MainController extends CoreController {

    public function home() {

        // Je demande au QuizModel de me donner la liste de toutes Quiz, pas besoin d'instancier le model car laméthode est static.
        // J'appelle la méthode findAll
        $quizList = QuizModel::findAllWithAuthorName();

        // J'affiche le rendu d'une template
        // Je fournis les données ($quizList) au template
        echo $this->templates->render ('main/home', [
            'quizList' => $quizList,        // Dans mon template $quizList sera disponible
        ]);
    }
}
