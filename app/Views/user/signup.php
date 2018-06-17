<?php $this->layout('layout') ?>

<div class="container">
    <?php if(!empty($errorList)) : ?>
        <div class="alert alert-danger" role="alert">
    <?= implode('<br>', $errorList) ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <form method="post" action="" class="col-md-8 m-auto signup-form">
            <div class="form-row col-md-12 m-auto">
                <div class="form-group col-md-6">
                    <label for="inputFirstName">Pr&eacute;nom</label>
                    <input type="text" name="firstName" class="form-control" id="inputFirstName" placeholder="Pr&eacute;nom">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputLastName">Nom</label>
                    <input type="text" name="lastName" class="form-control" id="inputLastName" placeholder="Nom">
                </div>
            </div>
            <div class="form-row col-md-12 m-auto">
                <div class="form-group col-md-12">
                    <label for="inputEmail">Adresse Email</label>
                    <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email">
                </div>
            </div>
            <div class="form-row col-md-12 m-auto">
                <div class="form-group col-md-6">
                    <label for="inputPassword">Mot de passe</label>
                    <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Mot de passe">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputConfirmPassword">Confirmation du mot de passe</label>
                    <input type="password" name="confirmPassword" class="form-control" id="inputConfirmPassword" placeholder="Confirmation du mot de passe">
                </div>
            </div>
            <button type="submit" class="btn btn-outline-success signup-btn">Confirmation de l'inscription&nbsp;<i class="fas fa-user-check signup-ico"></i></button>
        </form>
    </div>
</div>
