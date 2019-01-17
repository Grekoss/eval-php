<?php

namespace OQuiz\Controllers;

use OQuiz\Models\QuizModel;
use OQuiz\Models\QuestionModel;
use OQuiz\Models\UserModel;

class QuizController extends CoreController {

    public function quiz($allParams) {

        $id = (int) $allParams['id'];

        // On appelle la méthode find()
        $quiz = QuizModel::find($id);

        // Informations d'un quiz
        $questions = QuestionModel::findQuestionsByIdQuizWithLevel($id);

        // On mélange les réponses
        for ($i=0; $i<count($questions); $i++)
        {
            $listAnswers = array($questions[$i]->getProp1(), $questions[$i]->getProp2(), $questions[$i]->getProp3(), $questions[$i]->getProp4());
            shuffle($listAnswers);
            $mixedAnswers[] = $listAnswers;
        }

        // Trouver l'auteur des questions
        $author = UserModel::find($quiz->getIdAuthor());


        echo $this->templates->render ('quiz/quiz', [
            'quizId' => $id,
            'quiz' => $quiz,
            'questions' => $questions,
            'author' => $author,
            'answers' => $mixedAnswers,
        ]);
    }

    public function quizPost($allParams) {

        $id = (int) $allParams['id'];

        // Informations d'un quiz
        $questions = QuestionModel::findQuestionsByIdQuizWithLevel($id);

        // Rangement de POST dans un tableau
        $reponses = $_POST;


        // Création d'un tableau vide pour inscrire le réultat des réponses
        $result = array();

        // Nombre de points
        $score = 0;

        //Analyse du résultat
        for ($i=0; $i<count($questions); $i++)
        {
            // Pas de réponse à cette question>getId()]);
            if (!array_key_exists($questions[$i]->getId(), $reponses)) {
                $result[$i] = ['NULL', $questions[$i]->getId(), 0];
            }
            else
            {
                // C'est la bonne réponse
                if ($questions[$i]->getProp1() === $reponses[$questions[$i]->getId()])
                {
                    $result[$i] = ['GOOD', $questions[$i]->getId(), 1];
                    $score++;
                }
                else {
                    $result[$i] = ['BAD', $questions[$i]->getId(), 0];
                }
            }
        }

        $this->sendJSON([
            'result' => $result,
            'score' => $score,
        ]);
    }
}
