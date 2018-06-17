<?php

// namespace selon le PSR-4 configuré avec composer
namespace OQuiz;

// Impostation de AltoRouter
use \AltoRouter;

class Application {

    // Création de la propriété $router, et $config pour pouvoir utiliser cette propriété dans toutes mes méthodes. Cette propriété n'a pas besoin d'être publique, car utile uniquement dans ma Class
    private $router;
    private $config;

    public function __construct() {
        // Récupération de la configuration
        $this->config = parse_ini_file(__DIR__.'/config.conf');

        // J'instancie AltoRouter
        $this->router = new AltoRouter();

        // On travail en virtual host => ne rien mettre
        // sinon, en localhost, utiliser le setBasePath avec ceci :
        $this->router->setBasePath($this->config['BASEPATH']);

        // Méthode qui s'occupe des routes
        $this->definieRoutes();
    }

    public function run() {
        // Je fais le match d'une route par rapport à l'URL courante
        $match = $this->router->match();


        // Si on a un résultat (une route qui correspond)
        if ($match !== false) {
            // DISPATCH
            // explode() = renvoie un tableau string, à partir d'une autre string, en les séparant par un '#'
            $tmp = explode('#', $match['target']);
            // list permet d'affecter chaque élément du tableau $tmp dans des variables, en suivant l'ordre des variables
            list($controllerName, $methodName) = $tmp;

            // Je construit le FQCN correspondant au controller
            // On a besoion d'instancier la class à partir de son FQCN("chemin absolu") car on fait un new $fqcnControllerName
            $fqcnControllerName = '\OQuiz\Controllers\\'.$controllerName;
            // On instancie le controller
            $controller = new $fqcnControllerName($this);

            // J'appel la méthode
            $controller->$methodName($match['params']);
        }
        // Si ça ne match pas alors l'erreur 404
        else {
            header("HTTP/1.0 404 Not Found");
            exit;
        }
    }

    public function definieRoutes() {
        //Définition de toutes nos routes
        //Rappel : (exemple pour la page d'accueil 'home')
            // - GET => méthode HTTP GET (ou POST, ou les deux)
            // - '/' => correspond à l'URL
            // - 'MainController#home'
                // - 'MainController' => le nom du controller qui va s'occuper de cette page
                // - '#' => séparateur des 2 infos
                // - 'home' => méthode du controller qui va s'occuper de la page
            // - 'main_home' => le nom de cette route
        //MainController
        $this->router->map('GET', '/', 'MainController#home', 'main_home');
        //UserController
        $this->router->map('GET|POST', '/signup', 'UserController#signup', 'user_signup');
        $this->router->map('GET', '/login', 'UserController#login', 'user_login');
        $this->router->map('POST', '/login', 'UserController#loginPost', 'user_loginpost');
        $this->router->map('GET', '/logout', 'UserController#logout', 'user_logout');
        $this->router->map('GET', '/compte', 'UserController#compte', 'user_compte');
        $this->router->map('POST', '/compte', 'UserController#comptePost', 'user_comptepost');
        //Quiz
        $this->router->map('GET', '/quiz/[i:id]', 'QuizController#quiz', 'quiz_quiz');
        $this->router->map('POST', '/quiz/[i:id]', 'QuizController#quizPost', 'quiz_quizpost');
        //Test
        $this->router->map('GET', '/test', 'TestController#test', 'test_test');
    }

    public function getRouter() {
        return $this->router;
    }

    public function getConfig($key) {
        // si $key existe dans $this->getConfig
        if (array_key_exists($key, $this->config)) {
            // Je ne trouve pas toute la propriété config, mais uniquement une des données du tableau
            return $this->config[$key];
        }
        return false;
    }
}
