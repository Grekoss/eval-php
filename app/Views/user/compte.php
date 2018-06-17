<?php $this->layout('layout') ?>

<h1 class="profile-title">Mon compte : <em class="maj"><?= $connectedUser->getFirstName()?></em>&nbsp;<em class="maj"><?= $connectedUser->getLastName()?></em></h1>

<div class="profile-container">
    <div class="row profile-row">

        <div class="profile-container-cards col-8">
            <h2 class="profile-container-title">Vos quiz</h2>

            <div class="row profile-row">
                <?php foreach ($quizListUser as $currentQuiz) : ?>
                    <a class="quizzes-card profile-quizzes-card col-4" href="<?= $router->generate('quiz_quiz', ['id' => $currentQuiz->getId()]) ?>">
                        <div class="quizzes-title profile-quizzes-title"><?= $currentQuiz->getTitle() ?></div>
                        <div class="profile-quizzes-description"><?= $currentQuiz->getDescription() ?></div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="profile-container-informations col-4">
            <h2 class="profile-container-title">Modification des informations</h2>

            <div class="alert alert-danger login-alert" id="errorsDiv" role="alert" style="display:none;"></div>
            <div class="alert alert-success login-valid" id="validDiv" role="alert" style="display:none;">Vos modifications ont bien été prises en compte</div>

            <form method="post" action="" class="col-md-12 m-auto profile-form" id="formUpdateUser">
                <div class="form-row col-md-12 m-auto">
                    <div class="form-group col-md-6">
                        <label for="inputFirstName">Pr&eacute;nom</label>
                        <input type="text" name="firstName" class="form-control" id="inputFirstName" placeholder="Pr&eacute;nom" value="<?= $userModel->getFirstName() ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputLastName">Nom</label>
                        <input type="text" name="lastName" class="form-control" id="inputLastName" placeholder="Nom" value="<?= $userModel->getLastName() ?>">
                    </div>
                </div>
                <div class="form-row col-md-12 m-auto">
                    <div class="form-group col-md-12">
                        <label for="inputEmail">Adresse Email</label>
                        <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email" value="<?= $userModel->getEmail() ?>">
                    </div>
                </div>
                    <!--
                    <div class="form-group col-md-12">
                        <label for="inputPassword">Mot de passe</label>
                        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Mot de passe">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputConfirmPassword">Confirmation du mot de passe</label>
                        <input type="password" name="confirmPassword" class="form-control" id="inputConfirmPassword" placeholder="Confirmation du mot de passe">
                    </div>
                
                <button type="submit" class="btn btn-outline-success profile-btn">Modifier les informations</button> TODO a réactiver lorsque je serai ici pour la modif -->
            </form>

        </div>
    </div>
</div>
