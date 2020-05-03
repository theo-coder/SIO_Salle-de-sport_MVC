<?php
    include_once("./Views/viewMenu.php");
	switch($action) {

		case "register" :
			include_once("./Views/viewRegistration.php");
			$view->menu = new viewMenu();
			$view->body =  new viewRegistration();
        	break;
        
		case "registration" :
			include_once("./Views/viewRegistration.php");
			$view->menu = new viewMenu();
			$view->body =  new viewRegistration();
			if(!filter_var($_REQUEST["email"],FILTER_VALIDATE_EMAIL)){
				return $view->body->setMessage("Veuillez rentrer une adresse valide !");
			}
			if($_REQUEST["password"]!=$_REQUEST["password-verif"]){
				return $view->body->setMessage("Les mots de passe ne correspondent pas !");
			}
			if($pdo->userExist($_REQUEST["pseudo"])){
				$view->body->setMessage("Ce pseudo existe déjà");
			}else if($pdo->userExist($_REQUEST["email"],"mailUtilisateur")){
				$view->body->setMessage("Cet email existe déjà");
			} else {
				$pass = password_hash($_REQUEST["password"],PASSWORD_DEFAULT);
				if(($_REQUEST["pseudo"]!="") && ($_REQUEST["email"]!="") && ($pass!="")) {
					if($pdo->addRegistration($_REQUEST["email"], $_REQUEST["pseudo"], $pass)) {
						Session::setUserID($pdo->getUserId($_REQUEST["pseudo"]));
						Session::setUserType(0);
						header('Location:./index.php');
					} else {
						$view->body->setMessage("Erreur 500");
					}
				}else{
					$view->body->setMessage("Veuillez tout remplir !");
				}
			}
			
			break;
		case "connexion" :
			include_once("./Views/viewConnexion.php");
			$view->menu = new viewMenu();
			$view->body =  new viewConnexion();
			break;
		case "connect" :
			include_once("./Views/viewConnexion.php");
			include_once("./Views/viewHomeMenu.php");
			include_once("./Views/viewHome.php");
			if(($_REQUEST["pseudo"]!="") && ($_REQUEST["password"]!="")) {
				if($pdo->verifyRegistration($_REQUEST["pseudo"], $_REQUEST["password"])) {
					Session::setUserID($pdo->getUserId($_REQUEST["pseudo"]));
					Session::setUserType($pdo->getUserType(Session::getUserID()[0]));
					header('Location:./index.php');
				} else {
					$view->menu =  new viewMenu();
					$view->body =  new viewConnexion();
					$view->body->setMessage("Erreur, vous avez rentré les mauvais identifiants");
				}
			} else {
				$view->menu =  new viewMenu();
				$view->body =  new viewConnexion();
				$view->body->setMessage("Veuillez tout remplir !");
			}
			break;
		default :
			$view->menu = new viewMenu();
			break;
	}
	
	
?>