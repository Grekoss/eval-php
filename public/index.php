<?php

// Inclusion de Composer (Il s'occupe du autoload, avec PSR-4)
// __DIR__ => constante "magique" contenant le chemin absolu jusqu'au dossier du fichier actuel, ATTENTION, ne pas oublier le "/" juste après __DIR__
require(__DIR__.'/../vendor/autoload.php');

// Activation du système de session PHP
session_start();

// J'importe ma classe Application
use OQuiz\Application;

// J'instancie ma classe Application
$app = new Application();

// J'appelle la méthode "run"
$app->run();