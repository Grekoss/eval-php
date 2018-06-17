<nav class="nav nav-container">
    <div class="nav-title">O'Quiz</div>
    <div class="nav nav-principal">
        <div class="nav-user">
            <?php if($connectedUser !== false) : ?>
                Bonjour <strong class="nav-user-name"><?= $connectedUser->getFirstName() ?></strong>
            <?php else : ?>
                Bienvenue <strong>visiteur</strong>
            <?php endif; ?>
        </div>

        <a class="nav-link" href="<?= $router->generate('main_home')?>"><i class="fas fa-home"></i>&nbsp;Accueil</a>
        <?php if($connectedUser !== false) : ?>
            <a class="nav-link" href="<?= $router->generate('user_compte')?>"><i class="fas fa-user"></i>&nbsp;Mon compte</a>
            <a class="nav-link" href="<?= $router->generate('user_logout')?>"><i class="fas fa-sign-out-alt"></i>&nbsp;D&eacute;connexion</a>
        <?php else : ?>
            <a class="nav-link" href="<?= $router->generate('user_signup')?>"><i class="fas fa-edit"></i>&nbsp;Inscription</a>
            <a class="nav-link" href="<?= $router->generate('user_login')?>"><i class="fas fa-sign-in-alt"></i>&nbsp;Connection</a>
        <?php endif; ?>
    </div>
</nav>
