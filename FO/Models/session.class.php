<?php

class Session{

    public function __construct(){}

    /**
     * Défini l'id de l'utilisateur dans la session
     * @param int $id
     */
    public static function setUserID($id){
        $_SESSION['idUtilisateur'] = $id;
    }

    /**
     * Défini le type de l'utilisateur dans la session
     * @param int $type
     */
    public static function setUserType($type){
        $_SESSION['typeUtilisateur'] = $type;
    }

    /**
     * Retourne true si l'utilisateur à déjà un id de session
     * @return bool
     */
    public static function isLogged(){
        return isset($_SESSION['idUtilisateur']) ? true : false;
    }

    /**
     * Supprime l'utilisateur de la session
     */
    public static function removeUser(){
        session_destroy();
        unset($_SESSION);
    }

    /**
     * Retoune l'id de l'utilisateur s'il est défini sinon -1
     * @return int
     */
    public static function getUserID(){
        return isset($_SESSION) && isset($_SESSION['idUtilisateur']) ? $_SESSION['idUtilisateur'] : -1;
    }

    /**
     * Retoune le type de l'utilisateur s'il est défini sinon -1
     * @return int
     */
    public static function getUserType(){
        return isset($_SESSION) && isset($_SESSION['typeUtilisateur']) ? $_SESSION['typeUtilisateur'] : -1;
    }
}