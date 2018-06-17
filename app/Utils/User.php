<?php

namespace OQuiz\Utils;

// Class servant de librairie de user
class User {

	public static function isConnected() {
		return !empty($_SESSION['user']);
	}

    public static function getUser() {
        if(self::isConnected()) {
            return $_SESSION['user'];
        }
        return false;
    }

    public static function setUser($userModel) {
        if(is_object($userModel)) {
            $_SESSION['user'] = $userModel;
        }
    }

    public static function logout() {
        // Suppression uniquement de la variable user qui sert à la connexion
        unset($_SESSION['user']);
        // Je peux aussi supprimer toutes les données de session
        session_unset();
        // Je peux aussi supprimer la session complète
        session_destroy();
    }
}
