<?php

namespace OQuiz\Controllers;

use OQuiz\Models\UserModel;
use OQuiz\Models\QuizModel;
use OQuiz\Utils\User;

class UserController extends CoreController {

    public function signup() {
        // On sauvegarde la liste des erreurs dans un tableau
        $errorList = array ();

        //On distingue le POST du GET
        if(!empty($_POST)) {
            // On récupère les données
            $firstName = isset($_POST['firstName']) ? trim($_POST['firstName']) : '';
            $lastName = isset($_POST['lastName']) ? trim($_POST['lastName']) :  '';
            $email = isset($_POST['email']) ? trim($_POST['email']) : '';
            $password = isset($_POST['password']) ? trim($_POST['password']) : '';
            $confirmPassword = isset($_POST['confirmPassword']) ? trim($_POST['confirmPassword']) : '';

            // On valide les données
            if (empty($firstName)) {
                $errorList[] = 'Le prénom doit être renseigné';
            }
            if (empty($lastName)) {
                $errorList[] = 'Le nom doit être renseigné';
            }
            if (empty($email)) {
                $errorList[] = 'L\'adresse email doit être renseignée';
            }
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $errorList[] = 'L\'adresse email doit être renseignée';
            }
            if (empty($password)) {
                $errorList[] = 'Le mot de passe doit être renseigné';
            }
            if ($password != $confirmPassword) {
                $errorList[] = 'Le mot de passe de confirmation est incorrect';
            }
            if (strlen($password) < 8) {
                $errorList[] = 'Le mot de passe doit être au moins de 8 caractères';
            }

            // Si tout est OK (aucune erreur)
            if (count($errorList) == 0) {
                // On encode, hash, le mot de passe avant de le stocker en BDD
                $hash = password_hash($password, PASSWORD_DEFAULT);
                // Pour sauvegarder en BDD => On crée le Model
                $userModel = new UserModel();
                // On donne les valeurs à chaque propriétés
                $userModel->setFirstName($firstName);
                $userModel->setLastName($lastName);
                $userModel->setEmail($email);
                $userModel->setPassword($hash);

                // Je peux sauvegarder le model
                $insertedRows = $userModel->save();
                if ($insertedRows > 0) {
                    // On redirige l'user qui vient de créer un compte à la home en le connectant automatiquement. (Temps d'attente avant redirection => 1seconde)
                    User::setUser($userModel);
                    sleep(1);
                    $this->redirectToRoute('main_home');
                }
                else {
                    $errorList[] = 'Erreur dans l\'ajout à la DB';
                }
            }
        }
        // Rendu de la templates
        echo $this->templates->render ('user/signup', [
            'errorList' => $errorList,
        ]);
    }

    public function login() {

        echo $this->templates->render ('user/login');
    }

    // Méthode traitant les données du formulaire de login envoyés en Ajax
    public function loginPost() {
        // On sauvegarde la liste des erreurs dans un tableau
        $errorList = array();

        // On récupère les données
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';

        // On valide les données
        if (empty($email)) {
            $errorList[] = 'L\'adresse email doit être renseignée';
        }
        // Vérfification par un filtre de PHP que l'email est correct
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $errorList[] = 'L\'adresse email n\'est pas correcte';
        }
        if (empty($password)) {
            $errorList[] = 'Le mot de passe doit être renseigné';
        }
        
        // Si tout est OK (aucune erreur)
        if (count($errorList) == 0) {
            // On récupère le user correspondant au mot de passe, la méthode renvoie false si aucun résultat
            $userModel = UserModel::findByEmail($email);

            // Si on a un résultat en forme d'object
            if ($userModel !== false) {
                // Alors je test le mot de passe
                if (password_verify($password, $userModel->getPassword())) {
                    // On stock l'user en session, c'est suffisant pour connecter l'user.
                    User::setUser($userModel);
                    
                    // On affiche un JSON disant que tout est OK
                    $this->sendJSON([
                        'code' => 1,
                        'url' => $this->router->generate('main_home')
                    ]);
                }
                else {
                    $errorList[] = 'Le mot de passe est incorrect pour ce mail';
                }
            }
            else {
                $errorList[] = 'Aucun compte n\' été trouvé pour ce mail';
            }
        }
        // On envoie les erreurs au format JSON
        $this->sendJSON([
            'code' => 2,
            'errorList' => $errorList
        ]);
    }

    public function logout() {

        if (User::isConnected()) {
            // On appelle la méthode de la librairie User, permettant de se déconnecter
            User::logout();
            // Puis on redirige vers la home
            $this->redirectToRoute('main_home');
        }
        else {
            // User non connecté => redirection vers la page de connexion
            $this->redirectToRoute('user_login');
        }
    }

    public function compte() {
        
        if (User::isConnected()) {
            // User connecté
            $connectedUser = User::getUser();
            // Récupération des données sur l'user connecté
            // On redemande à la BDD les donnés car les données en session datent du moment où l'user s'est connecté
            $userModel = UserModel::find($connectedUser->getID());

            // On récupère la listes des quiz de l'user
            $quizListUser = QuizModel::findQuizzesByAuthor($connectedUser->getId());

            echo $this->templates->render ('user/compte', [
                'userModel' => $userModel,
                'quizListUser' => $quizListUser,
            ]);
        }
        else {
            // User non connecté => redirection vers la page de connexion
            $this->redirectToRoute('user_login');
        }
    }

    // Méthode traitant les données du formulaire du profil envoyés en Ajax
    public function comptePost() {
        // TODO pour faire l'UPDATE du membre
    }
}
