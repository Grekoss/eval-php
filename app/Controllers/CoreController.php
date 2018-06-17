<?php

namespace OQuiz\Controllers;

use OQuiz\Utils\User;

// Class "coeur" des Controllers sera hérité par les controllers pour hériter :
    // - de ses propriétés
    // - de ses méthodes

// abstract => Class abstraite => Interdiction d'instancier cette classe
abstract class CoreController {
    // Stock du moteur du Template, AltoRouter dans une propriété de la classe pour que ce soit accessible à toutes ses méthodes
    protected $templates;
    protected $router;

    // $app ) Application passé en paramêtre lors du "dispatch"
    public function __construct($app) {
        // Instance du moteur de template
        $this->templates = new \League\Plates\Engine(__DIR__.'/../Views');

        //Récupération des routes
        $this->router = $app->getRouter();

        // Je définis des données utiles pour toutes les templates
        $this->templates->addData([
            'title' => 'OQuiz',                                // => $title
            'basePath' => $app->getConfig('BASEPATH').'/',     // => $basePath
            'router' => $this->router,                         // => $router
            'connectedUser' => User::getUser(),                // => $connectedUser
        ]);
    }

    // Méthode permettant de rediriger vers une URL passée en paramètre
    public function redirect($url) {
        header('Location: '.$url);
        exit;
    }

    // Méthode permettant de rediriger vers une router de l'application
    public function redirectToRoute($routeName, $params=array()) {
        $this->redirect($this->router->generate($routeName, $params));
    }

    // Méthode permettant d'afficher un résultat sous forme de JSON
    public static function sendJSON($data) {
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    }
}