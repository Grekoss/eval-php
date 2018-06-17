<?php

namespace OQuiz\Controllers;

use OQuiz\Models\QuizModel;
use OQuiz\Models\QuestionModel;
use OQuiz\Models\UserModel;
use Oquiz\Models\User;
use OQuiz\Models\LevelModel;;

class QuizController extends CoreController {

    public function quiz($allParams) {

        $id = (int) $allParams['id'];

        // On appelle la méthode find()
        $quiz = QuizModel::find($id);

        // Informations d'un quiz
        $question = QuestionModel::findQuestionsByIdQuizWithLevel($id);

        // Trouver l'auteur des questions
        $author = UserModel::find($quiz->getIdAuthor());

        // Trouver le level
        $level = LevelModel::findAll();

        echo $this->templates->render ('quiz/quiz', [
            'quizId' => $id,
            'quiz' => $quiz,
            'question' => $question,
            'author' => $author,
            'level' => $level,
        ]);
    }

    public function quizPost($allParams) {

        $id = (int) $allParams['id'];

        $quiz = QuestionModel::findQuestionsByIdQuizWithLevel($id);

        // Rangement de POST dans un tableau
        $reponse = $_POST;

        // Création d'un tableau vide pour inscrire le réultat des réponses
        $result = array();

        // Nombre de points
        $score = 0;

        foreach ($quiz as $key => $question) {
            if(empty($reponse[$question->getId()])) {
                // Pas de réponse à cette question
                $result[$key] = ['NULL', $question->getId(),0];
            }
            else {
                if($reponse[$question->getId()] === 'BAD') {
                    // On a donnée la mauvaise réponse
                    $result[$key] = ['BAD', $question->getId(),0];
                }
                if($reponse[$question->getId()] === 'GOOD') {
                    // On a donnée la bonne réponse
                    $result[$key] = ['GOOD', $question->getId(),1];
                    $score++;
                }
            }
        }

        $this->sendJSON([
            'result' => $result,
            'score' => $score,
        ]);
    }
}
