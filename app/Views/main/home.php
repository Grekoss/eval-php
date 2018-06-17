<?php $this->layout('layout') ?>

<div class="welcome-container">
    <h1 class="welcome-title">Bienvenue sur O'Quiz</h1>
    <p class="welcome-description">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Maxime recusandae assumenda nesciunt? Provident praesentium consequatur, distinctio veniam aut quis. Nobis quidem nam aliquam officiis sequi ratione voluptatem vero facere consequatur! Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe tempore possimus ipsum suscipit sunt ea totam molestias vero molestiae est, qui in quam fugit at dicta laborum, eveniet reiciendis numquam! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero eveniet inventore aliquid magnam dolorum minima itaque cum suscipit dolores, quis, molestiae mollitia veniam nesciunt nemo necessitatibus, dolore officiis. Dolores, vero!</p>
</div>

<div class="quizzes-container">
    <div class="row quizzes-row">

        <?php foreach ($quizList as $currentQuiz) : ?>
            <a class="quizzes-card col-4" href="<?= $router->generate('quiz_quiz', ['id' => $currentQuiz->getId()]) ?>">
                <div class="quizzes-title"><?= $currentQuiz->getTitle() ?></div>
                <div class="quizzes-description"><?= $currentQuiz->getDescription() ?></div>
                <div class="quizzes-author">by <?= $currentQuiz->first_name ?> <?= $currentQuiz->last_name ?></div>
            </a>
        <?php endforeach; ?>

    </div>
</div>
