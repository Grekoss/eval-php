<?php $this->layout('layout') ?>

<script>var ID_QUIZ="<?= $quiz->getId() ?>";</script>

<div class="container">
    <div class="quiz-container-title">
        <h1 class="quiz-title"><?= $quiz->getTitle() ?><em class="quiz-title-count badge-secondary"><?= count($questions) ?>&nbsp;questions</em></h1>
        <div class="quiz-title-description"><?= $quiz->getDescription() ?></div>
        <div class="quiz-title-author">by <?= $author->getFirstName() ?>&nbsp;<?= $author->getLastName() ?></div>
    </div>

    <?php if($connectedUser !== false) : ?>

        <div class="alert alert-primary" id="quiz-newgame" role="alert">
            Nouveau jeu : Répondez au maximum de questions avant de valider
        </div>
        <div class="alert alert-success" id="quiz-score-box" role="alert">
            Votre score : <em id="quiz-score-txt"></em> / <?= count($questions) ?>
            <a class="quiz-replay-link" href="<?= $router->generate('quiz_quiz', ['id' => $quiz->getId()])?>">Rejouer</a>
        </div>

    <?php endif; ?>

    <form class="row" id="formQuiz" method="post" action="">
        <?php foreach ($questions as $key => $currentQuestion) : ?>
            <div class="quiz-question-card col-4 card">
                <div class="quiz-question-title card-header">
                    <div class="quiz-question-level badge level-<?= $currentQuestion->getIdLevel()?>"><?= $currentQuestion->name ?></div>
                    <?= $currentQuestion->getQuestion() ?>
                </div>
                <div class="quiz-question-container-answers">

                    <?php foreach ($answers[$key] as $answer) : ?>
                        <?php if($connectedUser !== false) : ?>

                            <div class="form-check quiz-question-liste-radio">
                                <input class="form-check-input" type="radio" id="<?= $currentQuestion->getId() ?>-<?= str_replace(' ','',$answer) ?>" name="<?= $currentQuestion->getId() ?>" value="<?= trim($answer) ?>" >
                                <label class="form-check-label" for="<?= $currentQuestion->getId() ?>-<?= str_replace(' ','',$answer) ?>"><?= $answer ?></label>
                            </div>

                        <?php else : ?>

                            <ol class="quiz-question-liste">
                                <li class="quiz-question-liste-item"><?= $answer ?></li>
                            </ol>

                        <?php endif; ?>
                    <?php endforeach; ?>

                </div>
                <div class="card quiz-question-anecdote-container card-header" id="cardInfo-<?= $currentQuestion->getId()?>">
                    <div class="quiz-question-anecdote"><?= $currentQuestion->getAnecdote() ?></div>
                    <a class="quiz-question-anecdote-link" href="https://fr.wikipedia.org/wiki/<?= $currentQuestion->getWiki() ?>" target="_blank">wikipedia(<?= $currentQuestion->getWiki()?>)</a>
                </div>
            </div>
        <?php endforeach; ?>
        <?php if($connectedUser !== false) : ?>
            <button id="quiz-btn-valid" type="submit" class="btn quiz-btn quiz-btn-valid">Valider vos réponses</button>
            <a id="quiz-btn-replay" href="<?= $router->generate('quiz_quiz', ['id' => $quiz->getId()])?>" class="btn quiz-btn btn-success quiz-btn-replay" role="button" title="Rejouer 1">Rejouer</a>

        <?php endif; ?>

    </form>
</div>
