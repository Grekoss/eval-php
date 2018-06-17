<?php $this->layout('layout') ?>

<div class="container login-container">
    <h1 class="login-title">Connexion</h1>

    <div class="alert alert-danger login-alert" id="errorsDiv" role="alert" style="display:none;"></div>
    <div class="alert alert-success login-valid" id="validDiv" role="alert" style="display:none;">Connexion OK, vous allez être redirigé automatiquement sur la page d'accueil</div>

    <div class="row">       
        <form class="col-md-6 signup-form" action="" method="post" id="formLogin">
            <div class="form-group">
                <label for="inputEmail">Adresse email</label>
                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Adresse email">
            </div>
            <div class="form-group">
                <label for="inputPassword">Mot de passe</label>
                <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Mot de passe">
            </div>
            <button type="submit" class="btn btn-success login-btn">Connection</button>
        </form>
    </div>
</div>