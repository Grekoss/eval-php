<?php

// Inclusion of Composer (He is busy with the autoload, with PSR-4)
// __DIR__ => "magic" constant containing the absolute path to the current file folder, CAUTION, do not forget the "/" just after __DIR__
require(__DIR__.'/../vendor/autoload.php');

// Activation of the PHP session system
session_start();

// Importing the Application class
use OQuiz\Application;

// Instantiates the Application class
$app = new Application();

// Call of the "run" method
$app->run();