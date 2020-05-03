<?php
    include_once("./Views/viewMenu.php");
	switch($action) {
		case "view" :
			include_once("./Views/viewAccount.php");
			$view->menu = new viewMenu();
			$view->body =  new viewAccount();
            $view->body->getUserPseudo($pdo->getUserPseudo(Session::getUserID()[0]));
            $view->body->getUserEmail($pdo->getUserEmail(Session::getUserID()[0]));
			$view->body->getNewsletterInscrit($pdo->getInscritNewsletter(Session::getUserID()[0]));
			$view->body->getUserName($pdo->getUserName(Session::getUserID()[0]));
			$view->body->getUserFirstname($pdo->getUserFirstname(Session::getUserID()[0]));
			$view->body->getUserGender($pdo->getUserGender(Session::getUserID()[0]));
			
			if(isset($_REQUEST['accountSubmit'])){
				$pseudo = $_REQUEST['pseudo'];
				$email = $_REQUEST['email'];
				$newsletter = $_REQUEST['newsletter'];
				$name = $_REQUEST['name'];
				$firstname = $_REQUEST['firstname'];
				$gender = $_REQUEST['gender'];
				$pass = $_REQUEST['pass'];
				$passverif = $_REQUEST['passVerify'];

				if($pseudo){
					if($pdo->userExist($pseudo)){
						return $view->body->setMessage("Ce pseudo est déjà utilisé !");
					} else {
						// header('Location:./index.php?case=FO_Account&action=view');
						$pdo->updatePseudo($pseudo,Session::getUserID()[0]);
					}
				}
				if($email){
					if($pdo->userExist($email, "mailUtilisateur")){
						return $view->body->setMessage("Cet email est déjà utilisé !");
					} else {
						if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
							return $view->body->setMessage("Veuillez rentrer une adresse valide !");
						} else {
							if($pdo->getInscritNewsletter(Session::getUserID()[0])){
								// header('Refresh:0');
								$pdo->updateEmailNewsletter($email,$pdo->getUserEmail(Session::getUserID()[0])['mailUtilisateur']);
								$pdo->updateEmail($email,Session::getUserID()[0]);
							}else{
								// header('Refresh:0');
								$pdo->updateEmail($email,Session::getUserID()[0]);
							}
						}
					}
				}
				if($newsletter){
					if(!$pdo->getInscritNewsletter(Session::getUserID()[0])){
						$pdo->addSubscription($pdo->getUserEmail(Session::getUserID()[0])['mailUtilisateur']);
						if($pdo->getUserName(Session::getUserID()[0])['nom']){
							$pdo->editSubscriptionName($pdo->getUserEmail(Session::getUserID()[0])['mailUtilisateur'],$pdo->getUserName(Session::getUserID()[0])['nom']);
						}
						if($pdo->getUserFirstname(Session::getUserID()[0])['prenom']){
							$pdo->editSubscriptionFirstname($pdo->getUserEmail(Session::getUserID()[0])['mailUtilisateur'],$pdo->getUserFirstname(Session::getUserID()[0])['prenom']);
						}
						if($pdo->getUserGender(Session::getUserID()[0])['genre']){
							$pdo->editSubscriptionGender($pdo->getUserEmail(Session::getUserID()[0])['mailUtilisateur'],$pdo->getUserGender(Session::getUserID()[0])['genre']);
						}
						//header('Refresh:0');
					}
				} else {
					if($pdo->getInscritNewsletter(Session::getUserID()[0])){
						$pdo->removeSubscription($pdo->getUserEmail(Session::getUserID()[0])['mailUtilisateur']);
						// header('Refresh:0');
					}
				}
				if($name){
					if($pdo->getInscritNewsletter(Session::getUserID()[0])){
						$pdo->updateUserNameNewsletter($name,$pdo->getUserEmail(Session::getUserID()[0])['mailUtilisateur']);
						$pdo->updateUserName($name,Session::getUserID()[0]);
						// header('Refresh:0');
					}else{
						$pdo->updateUserName($name,Session::getUserID()[0]);
						// header('Refresh:0');
					}
				}
				if($firstname){
					if($pdo->getInscritNewsletter(Session::getUserID()[0])){
						$pdo->updateUserFirstnameNewsletter($firstname,$pdo->getUserEmail(Session::getUserID()[0])['mailUtilisateur']);
						$pdo->updateUserFirstname($firstname,Session::getUserID()[0]);
						// header('Refresh:0');
					}else{
						$pdo->updateUserFirstname($firstname,Session::getUserID()[0]);
						// header('Refresh:0');
					}
				}
				if($gender){
					if($gender=="1"){
						$gender="H";
						if($pdo->getInscritNewsletter(Session::getUserID()[0])){
							$pdo->updateUserGenderNewsletter($gender,$pdo->getUserEmail(Session::getUserID()[0])['mailUtilisateur']);
							$pdo->updateUserGender($gender,Session::getUserID()[0]);
							// header('Refresh:0');
						}else{
							$pdo->updateUserGender($gender,Session::getUserID()[0]);
							// header('Refresh:0');
						}
					} else {
						$gender="F";
						if($pdo->getInscritNewsletter(Session::getUserID()[0])){
							$pdo->updateUserGenderNewsletter($gender,$pdo->getUserEmail(Session::getUserID()[0])['mailUtilisateur']);
							$pdo->updateUserGender($gender,Session::getUserID()[0]);
							// header('Refresh:0');
						}else{
							$pdo->updateUserGender($gender,Session::getUserID()[0]);
							// header('Refresh:0');
						}
					}
				}
				if($pass){
					if($passverif===$pass){
						$pass = password_hash($pass,PASSWORD_DEFAULT);
						$pdo->updatePassword($pass, Session::getUserID()[0]);
					}else{
						return $view->body->setMessage("Veuillez vérifier votre mot de passe !");
					}
				}
				
				//print_r($pseudo."\n".$email."\n".$newsletter."\n".$name."\n".$firstname."\n".$gender."\n".$pass."\n".$passverif);
				header('Refresh:0');
			}
        	break;
		default :
			$view->menu = new viewMenu();
			break;
	}
	
	
?>