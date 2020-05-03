<?php
class PDO_SDS {

    private static $pdo = null;
    //private $id;

	const SQL_SERVER = "127.0.0.1";
    const BDD = "DB_SDS";
    const USER = "root";
    const MDP = "azerty";
    
    function __construct() {
		try {
			if(self::$pdo == null) {
                self::$pdo = new PDO('mysql:host='.self::SQL_SERVER.';dbname='.self::BDD, self::USER, self::MDP, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
            }
		}
		catch (Exception $e) {
			die('Erreur __construct : ' . $e->getMessage());
		}
    }
    function getUserType($id){
        $req = self::$pdo->prepare("SELECT typeUtilisateur FROM UTILISATEUR WHERE idUtilisateur = :id");
        $req->bindParam('id', $id);
        $req->execute();
        $res = $req->fetch();
        return $res;
    }
    function getUserName($id){
        $req = self::$pdo->prepare("SELECT nom FROM UTILISATEUR WHERE idUtilisateur = :id");
        $req->bindParam('id', $id);
        $req->execute();
        $res = $req->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    function getUserFirstname($id){
        $req = self::$pdo->prepare("SELECT prenom FROM UTILISATEUR WHERE idUtilisateur = :id");
        $req->bindParam('id', $id);
        $req->execute();
        $res = $req->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    function getUserGender($id){
        $req = self::$pdo->prepare("SELECT genre FROM UTILISATEUR WHERE idUtilisateur = :id");
        $req->bindParam('id', $id);
        $req->execute();
        $res = $req->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    function addSubscription($mail, $name = null, $firstName = null, $gender = null){
        $req = self::$pdo->prepare('INSERT INTO `NEWSLETTER` (`mail`,`prenom`,`nom`,`genre`) VALUES (:mail, :firstName, :name, :gender);');
        $req->bindParam('mail',$mail);
        $req->bindParam('firstName',$firstName);
        $req->bindParam('name',$name);
        $req->bindParam('gender',$gender);
        $res=$req->execute();
        return $res;
    }
    function editSubscriptionName($mail, $name){
        $req = self::$pdo->prepare('UPDATE `NEWSLETTER` SET `nom`=:name WHERE `mail`=:mail');
        $req->bindParam('mail',$mail);
        $req->bindParam('name',$name);
        $res=$req->execute();
        return $res;
    }
    function editSubscriptionFirstname($mail, $firstname){
        $req = self::$pdo->prepare('UPDATE `NEWSLETTER` SET `prenom`=:firstname WHERE `mail`=:mail');
        $req->bindParam('mail',$mail);
        $req->bindParam('firstname',$firstname);
        $res=$req->execute();
        return $res;
    }
    function editSubscriptionGender($mail, $gender){
        $req = self::$pdo->prepare('UPDATE `NEWSLETTER` SET `genre`=:gender WHERE `mail`=:mail');
        $req->bindParam('mail',$mail);
        $req->bindParam('gender',$gender);
        $res=$req->execute();
        return $res;
    }
    function removeSubscription($mail){
        $req =  self::$pdo->prepare('DELETE FROM `NEWSLETTER` where `mail` = :mail');
        $req->bindParam('mail',$mail);
        $res = $req->execute();
        return $res;
    }

    function addRegistration($mailUtilisateur, $pseudo, $motDePasse){
        $req =  self::$pdo->prepare('INSERT INTO `UTILISATEUR` (`idUtilisateur`,`typeUtilisateur`,`mailUtilisateur`,`pseudo`,`motDePasse`) VALUES (NULL, 0, :mailUtilisateur, :pseudo, :motDePasse);');
        $req->bindParam('mailUtilisateur',$mailUtilisateur);
        $req->bindParam('pseudo',$pseudo);
        $req->bindParam('motDePasse',$motDePasse);
        $res = $req->execute();
        return $res;
    }
    function userExist($value, $type = "pseudo"){
        $req = self::$pdo->prepare("SELECT * FROM UTILISATEUR WHERE {$type} = :{$type}");
        $req->bindParam($type,$value);
        $req->execute();
        $res = $req->fetch();
        return ((empty($res)) ? false : true);
    }
    function getUserId($pseudo) {
        $req = self::$pdo->prepare("SELECT idUtilisateur FROM UTILISATEUR WHERE pseudo = :pseudo");
        $req->bindParam('pseudo', $pseudo);
        $req->execute();
        $res = $req->fetch();
        return $res;
    }
    function listeInscrits(){
        $req =  self::$pdo->prepare('SELECT * FROM `NEWSLETTER`');
        $res = $req->execute();
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function listeUsers(){
        $req =  self::$pdo->prepare('SELECT * FROM `UTILISATEUR`');
        $res = $req->execute();
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function getInscritNewsletter($id) {
        $reqUser = self::$pdo->prepare("SELECT mailUtilisateur FROM UTILISATEUR WHERE idUtilisateur = :id");
        $reqUser->bindParam('id', $id);
        $reqUser->execute();
        $resUser = $reqUser->fetch()['mailUtilisateur'];
        $compteur=0;
        for($i=0;$i<count($this->listeInscrits());$i++,$compteur++){
            if($this->listeInscrits()[$i]['mail']==$resUser){
                return true;
            }
            if($compteur==count($this->listeInscrits())){
                return false;
            }
        }
    }

    function getUserEmail($id){
        $req =  self::$pdo->prepare('SELECT mailUtilisateur FROM `UTILISATEUR` where `idUtilisateur` =:id;');
        $req->bindParam('id', $id);
        $res = $req->execute();
		$res = $req->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    function verifyRegistration($pseudo, $motDePasse){
        $req =  self::$pdo->prepare('SELECT * FROM `UTILISATEUR` where `pseudo` =:pseudo;');
        $req->bindParam('pseudo', $pseudo);
        $res = $req->execute(); //$reponse boolean sur l'état de la requête 
		$line = $req->fetch(PDO::FETCH_ASSOC);
		if($line != false){
            if(password_verify($motDePasse, $line["motDePasse"])){
                //print_r($this->id);
                return $line; //Trouvé et mdp ok
            }
			else 
				return false; //pseudo trouvé, mais MDP pas bon
		}
		else
			return false; //Pseudo pas trouvé
		
        return $res;
    }

    /*function getId(){
        return $this->id;
    }*/
    function getUserPseudo($id){
        $req =  self::$pdo->prepare('SELECT pseudo FROM `UTILISATEUR` where `idUtilisateur` =:id;');
        $req->bindParam('id', $id);
        $res = $req->execute();
		$res = $req->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    function updatePseudo($pseudo, $id){
        $req =  self::$pdo->prepare('UPDATE `UTILISATEUR` SET `pseudo`=:pseudo WHERE `idUtilisateur`=:id');
        $req->bindParam('id', $id);
        $req->bindParam('pseudo', $pseudo);
        $res = $req->execute();
        return $res;
    }
    function updateEmail($email, $id){
        $req =  self::$pdo->prepare('UPDATE `UTILISATEUR` SET `mailUtilisateur`=:email WHERE `idUtilisateur`=:id');
        $req->bindParam('id', $id);
        $req->bindParam('email', $email);
        $res = $req->execute();
        return $res;
    }
    function updateAccountType($type, $id){
        $req =  self::$pdo->prepare('UPDATE `UTILISATEUR` SET `typeUtilisateur`=:type WHERE `idUtilisateur`=:id');
        $req->bindParam('id', $id);
        $req->bindParam('type', $type);
        $res = $req->execute();
        return $res;
    }
    function getGymComments(){
        $req =  self::$pdo->prepare('SELECT * FROM `COMMENTAIRE_SALLE`;');
        $res = $req->execute();
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function getUser(){
        $req =  self::$pdo->prepare('SELECT * FROM `UTILISATEUR`');
        $res = $req->execute();
		$res = $req->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function getCategories(){
        $req =  self::$pdo->prepare('SELECT * FROM `CATEGORIE`');
        $res = $req->execute();
		$res = $req->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function addCateg($titre){
        $req =  self::$pdo->prepare('INSERT INTO `CATEGORIE` (`titre`) VALUES (:titre);');
        $req->bindParam('titre', $titre);
        $res = $req->execute();
        return $res;
    }
    function addArticle($titre,$image,$texte,$user,$categ){
        $req =  self::$pdo->prepare('INSERT INTO `ARTICLE` (`dateArticle, titre, imageArticle, texteHtml, idUtilisateur, idCategorie`) VALUES (Date(Now()), :titre, :image, :texte, :user, :categ);');
        $req->bindParam('titre', $titre);
        $req->bindParam('image', $image);
        $req->bindParam('texte', $texte);
        $req->bindParam('user', $user);
        $req->bindParam('categ', $categ);
        $res = $req->execute();
        return $res;
    }
    function editArticle($titre,$image,$texte,$user,$categ){
        $req =  self::$pdo->prepare('UPDATE `ARTICLE` SET `dateArticle`=Date(Now()), `titre`=:titre, `imageArticle`=:image, `texteHtml`=:texte, `idUtilisateur`=:user, `idCategorie`=:categ;');
        $req->bindParam('titre', $titre);
        $req->bindParam('image', $image);
        $req->bindParam('texte', $texte);
        $req->bindParam('user', $user);
        $req->bindParam('categ', $categ);
        $res = $req->execute();
        return $res;
    }
    function getArticles(){
        $req =  self::$pdo->prepare('SELECT * FROM `ARTICLE`');
        $res = $req->execute();
		$res = $req->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function removeArticle($id){
        $req =  self::$pdo->prepare('DELETE FROM `ARTICLE` WHERE idArticle = :id');
        $req->bindParam('id', $id);
        $res = $req->execute();
        return $res;
    }
    function getArticlesById($idCateg){
        $req =  self::$pdo->prepare('SELECT * FROM `ARTICLE` WHERE `idCategorie` = :idCateg');
        $req->bindParam('idCateg', $idCateg);
        $res = $req->execute();
		$res = $req->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function removeComment($id){
        $req =  self::$pdo->prepare('DELETE FROM `COMMENTAIRE_SALLE` WHERE idCommentaire = :id');
        $req->bindParam('id', $id);
        $res = $req->execute();
        return $res;
    }
    function updateEmailNewsletter($email,$oldMail){
        $req =  self::$pdo->prepare('UPDATE `NEWSLETTER` SET `mail`=:email WHERE `mail`=:oldMail');
        $req->bindParam('oldMail', $oldMail);
        $req->bindParam('email', $email);
        $res = $req->execute();
        return $res;
    }
    function getUserDate($id){
        $req =  self::$pdo->prepare('SELECT * FROM `UTILISATEUR` where `idUtilisateur` =:id;');
        $req->bindParam('id', $id);
        $res = $req->execute();
		$res = $req->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    function updateUserName($nom,$id){
        $req =  self::$pdo->prepare('UPDATE `UTILISATEUR` SET `nom`=:nom WHERE `idUtilisateur`=:id');
        $req->bindParam('id', $id);
        $req->bindParam('nom', $nom);
        $res = $req->execute();
        return $res;
    }
    function updateUserNameNewsletter($name,$email){
        $req =  self::$pdo->prepare('UPDATE `NEWSLETTER` SET `nom`=:name WHERE `mail`=:email');
        $req->bindParam('email', $email);
        $req->bindParam('name', $name);
        $res = $req->execute();
        return $res;
    }
    function updateUserFirstname($prenom,$id){
        $req =  self::$pdo->prepare('UPDATE `UTILISATEUR` SET `prenom`=:prenom WHERE `idUtilisateur`=:id');
        $req->bindParam('id', $id);
        $req->bindParam('prenom', $prenom);
        $res = $req->execute();
        return $res;
    }
    function updateUserFirstnameNewsletter($prenom,$email){
        $req =  self::$pdo->prepare('UPDATE `NEWSLETTER` SET `prenom`=:prenom WHERE `mail`=:email');
        $req->bindParam('email', $email);
        $req->bindParam('prenom', $prenom);
        $res = $req->execute();
        return $res;
    }
    function updateUserGender($genre,$id){
        $req =  self::$pdo->prepare('UPDATE `UTILISATEUR` SET `genre`=:genre WHERE `idUtilisateur`=:id');
        $req->bindParam('id', $id);
        $req->bindParam('genre', $genre);
        $res = $req->execute();
        return $res;
    }
    function updateUserGenderNewsletter($genre,$email){
        $req =  self::$pdo->prepare('UPDATE `NEWSLETTER` SET `genre`=:genre WHERE `mail`=:email');
        $req->bindParam('email', $email);
        $req->bindParam('genre', $genre);
        $res = $req->execute();
        return $res;
    }
    function updatePassword($pass,$id){
        $req =  self::$pdo->prepare('UPDATE `UTILISATEUR` SET `motDePasse`=:pass WHERE `idUtilisateur`=:id');
        $req->bindParam('id', $id);
        $req->bindParam('pass', $pass);
        $res = $req->execute();
        return $res;
    }
    function deleteUser($id){
        $req =  self::$pdo->prepare('DELETE FROM `UTILISATEUR` WHERE idUtilisateur = :id');
        $req->bindParam('id', $id);
        $res = $req->execute();
        return $res;
    }
}
?>