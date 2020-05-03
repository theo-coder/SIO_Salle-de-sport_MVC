<?php
	include_once("./Views/viewMenu.php");
	include_once("./Views/viewUsers.php");
	//error_reporting(E_ALL);
	//ini_set("display_errors", 1);
	
	switch($action) {

		case "view" :
			
			$view->menu =  new viewMenu();
			$view->body =  new viewUsers();
			
			$view->body->listeInscrits($pdo->listeUsers());
			
			if(isset($_REQUEST['valider'])){
				
				$id = $_REQUEST['id'];
				$pseudo = $_REQUEST['pseudo'];
				$name = $_REQUEST['nom'];
				$firstname = $_REQUEST['prenom'];
				$mail = $_REQUEST['email'];
				$bouser = $_REQUEST['BOUser'];
				$adminUser = $_REQUEST['adminUser'];
				if($pseudo){
					if($pdo->userExist($pseudo)){
						return $view->body->setMessage("Ce pseudo est déjà utilisé !");
					} else {
						$pdo->updatePseudo($pseudo,$id);
					}
				}
				if($name){
					if($pdo->getInscritNewsletter($id)){
						$pdo->updateUserNameNewsletter($name,$pdo->getUserEmail($id));
						$pdo->updateUserName($name,$id);
					}else{
						$pdo->updateUserName($name,$id);
					}
				}
				if($firstname){
					if($pdo->getInscritNewsletter($id)){
						$pdo->updateUserFirstnameNewsletter($firstname,$pdo->getUserEmail($id));
						$pdo->updateUserFirstname($firstname,$id);
					}else{
						$pdo->updateUserFirstname($firstname,$id);
					}
				}
				if($mail){
					if($pdo->userExist($mail, "mailUtilisateur")){
						return $view->body->setMessage("Cet email est déjà utilisé !");
					} else {
						if(!filter_var($mail,FILTER_VALIDATE_EMAIL)){
							return $view->body->setMessage("Veuillez rentrer une adresse valide !");
						} else {
							if($pdo->getInscritNewsletter($id)){
								$pdo->updateEmailNewsletter($mail,$pdo->getUserEmail($id)['mailUtilisateur']);
								$pdo->updateEmail($mail,$id);
							}else{
								$pdo->updateEmail($mail,$id);
							}
						}
					}
				}
				if($bouser){
					$pdo->updateAccountType(1,$id);
				} else {
					$pdo->updateAccountType(0,$id);
				}
				if($adminUser){
					$pdo->updateAccountType(2,$id);
				} else {
					if($bouser){
						$pdo->updateAccountType(1,$id);
					} else {
						$pdo->updateAccountType(0,$id);
					}
				}
				header('Refresh:0');
			}
			break;

		default :
			$view->menu = new viewMenu();
			break;
	}
	
	
?>