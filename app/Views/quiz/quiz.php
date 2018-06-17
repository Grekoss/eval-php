<?php $this->layout('layout') ?>

<script>var ID_QUIZ="<?= $quiz->getId() ?>";</script>

<div class="container">
    <div class="quiz-container-title">
        <h1 class="quiz-title"><?= $quiz->getTitle() ?><em class="quiz-title-count badge-secondary"><?= count($question) ?>&nbsp;questions</em></h1>
        <div class="quiz-title-description"><?= $quiz->getDescription() ?></div>
        <div class="quiz-title-author">by <?= $author->getFirstName() ?>&nbsp;<?= $author->getLastName() ?></div>
    </div>


    <?php if($connectedUser !== false) : ?>
    <div class="alert alert-primary" id="quiz-newgame" role="alert">
        Nouveau jeu : Répondez au maximum de questions avant de valider
    </div>
    <div class="alert alert-success" id="quiz-score-box" role="alert" style="display:none">
        Votre score : <em id="quiz-score-txt"></em> / <?= count($question) ?>
        <a class="quiz-replay-link" href="<?= $router->generate('quiz_quiz', ['id' => $quiz->getId()])?>">Rejouer</a>
    </div>
    <?php endif; ?>

    <form class="row" id="formQuiz" method="post" action="">
        <?php foreach ($question as $currentQuestion) : ?>

            <?php
            // Balise PHP pour la création de l'array contenant les propositions de faire un shuffle avec
            $reponses = array($currentQuestion->getProp1(), $currentQuestion->getProp2(), $currentQuestion->getProp3(), $currentQuestion->getProp4());
            // Mélange de l'array
            shuffle($reponses);
            ?>

            <div class="quiz-question-card col-4 card">
                <div class="quiz-question-title card-header">
                    <div class="quiz-question-level badge level-<?= $currentQuestion->getIdLevel()?>"><?= $currentQuestion->name ?></div>
                    <?= $currentQuestion->getQuestion() ?>
                </div>
                <div class="quiz-question-container-answers">
                
                <?php if($connectedUser !== false) : ?>

                    <div class="form-check quiz-question-liste-radio">
                        <input class="form-check-input" type="radio" id="<?= trim($reponses[0]) ?>-<?= $currentQuestion->getId() ?>" name="<?= $currentQuestion->getId() ?>" value="<?= ($reponses[0] === $currentQuestion->getProp1()) ? 'GOOD' : 'BAD'  ?>">
                        <label class="form-check-label" for="<?= trim($reponses[0])?>-<?= $currentQuestion->getId() ?>"><?= $reponses[0] ?></label>
                    </div>
                    <div class="form-check quiz-question-liste-radio">
                        <input class="form-check-input" type="radio" id="<?= trim($reponses[1]) ?>-<?= $currentQuestion->getId() ?>" name="<?= $currentQuestion->getId() ?>" value="<?= ($reponses[1] === $currentQuestion->getProp1()) ? 'GOOD' : 'BAD'  ?>">
                        <label class="form-check-label" for="<?= trim($reponses[1])?>-<?= $currentQuestion->getId() ?>"><?= $reponses[1] ?></label>
                    </div>
                    <div class="form-check quiz-question-liste-radio">
                        <input class="form-check-input" type="radio" id="<?= trim($reponses[2]) ?>-<?= $currentQuestion->getId() ?>" name="<?= $currentQuestion->getId() ?>" value="<?= ($reponses[2] === $currentQuestion->getProp1()) ? 'GOOD' : 'BAD'  ?>">
                        <label class="form-check-label" for="<?= trim($reponses[2])?>-<?= $currentQuestion->getId() ?>"><?= $reponses[2] ?></label>
                    </div>
                    <div class="form-check quiz-question-liste-radio">
                        <input class="form-check-input" type="radio" id="<?= trim($reponses[3]) ?>-<?= $currentQuestion->getId() ?>" name="<?= $currentQuestion->getId() ?>" value="<?= ($reponses[3] === $currentQuestion->getProp1()) ? 'GOOD' : 'BAD'  ?>">
                        <label class="form-check-label" for="<?= trim($reponses[3])?>-<?= $currentQuestion->getId() ?>"><?= $reponses[3] ?></label>
                    </div> 

                <?php else : ?>

                    <ol class="quiz-question-liste">
                        <li class="quiz-question-liste-item"><?= $reponses[0] ?></li>
                        <li class="quiz-question-liste-item"><?= $reponses[1] ?></li>
                        <li class="quiz-question-liste-item"><?= $reponses[2] ?></li>
                        <li class="quiz-question-liste-item"><?= $reponses[3] ?></li>
                    </ol>
                
                <?php endif; ?>
                </div>
                <div class="card quiz-question-anecdote-container card-header" id="cardInfo-<?= $currentQuestion->getId()?>" style="display:none">
                    <div class="quiz-question-anecdote"><?= $currentQuestion->getAnecdote() ?></div>
                    <a class="quiz-question-anecdote-link" href="https://fr.wikipedia.org/wiki/<?= $currentQuestion->getWiki() ?>" target="_blank">wikipedia(<?= $currentQuestion->getWiki()?>)</a>
                </div>
            </div>
        <?php endforeach; ?>
        <?php if($connectedUser !== false) : ?>
            <button id="quiz-btn-valid" type="submit" class="btn quiz-btn quiz-btn-valid">Valider vos réponses</button>
            <a id="quiz-btn-replay" href="<?= $router->generate('quiz_quiz', ['id' => $quiz->getId()])?>" class="btn quiz-btn btn-success quiz-btn-replay" role="button" style="display:none" title="Rejouer 1">Rejouer</a>
        <?php endif; ?>
    </form>
</div>
