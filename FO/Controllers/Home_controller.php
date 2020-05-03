<?php
	include_once("./Views/viewHomeMenu.php");
	include_once("./Views/viewHome.php");
	//include_once("./Views/viewFooter.php");
	error_reporting(E_ALL);
	ini_set("display_errors", 1);

	$view->menu = new viewHomeMenu();
	$view->body = new viewHome();
	$view->menu->getUserPseudo($pdo->getUserPseudo(Session::getUserID()[0]));
	$view->menu->getUserEmail($pdo->getUserEmail(Session::getUserID()[0]));
	$view->menu->getNewsletterInscrit($pdo->getInscritNewsletter(Session::getUserID()[0]));
	$view->menu->getTypeUser($pdo->getUserType(Session::getUserID()[0]));
	$view->body->getGymComments($pdo->getGymComments());
	$view->body->getUser($pdo->getUser());
	//$view->footer = new viewFooter();
	if(isset($_REQUEST['validate'])){

		$uploadDir= $_SERVER['DOCUMENT_ROOT']."/PHP/Projet/FO/Tools/uploads/";
		$tmpFile=$_FILES['avatar']['tmp_name'];
		if(!is_uploaded_file($tmpFile)){
			exit("Le fichier est introuvable");
		}

		$typeFile=$_FILES['avatar']['type'];
		$extensions = ['image/jpg', 'image/jpeg', 'image/png'];

		if (!in_array($typeFile, $extensions)) {
			exit("Le fichier n'est pas une image");
		}
		$extFile=explode("/",$typeFile);
		$nameFile = Session::getUserID()[0].'.'.$extFile[1];
		if(file_exists($uploadDir . $nameFile)) {
			unlink($uploadDir . $nameFile); //remove the file
		}
		if(!move_uploaded_file($tmpFile, $uploadDir . $nameFile)){
        	exit("Impossible de copier le fichier dans $uploadDir");
		}
	}
	if(isset($_REQUEST['sendComment'])){
		$content = $_REQUEST['commentContent'];
		if(trim($content) == ""){
			$view->body->setMessage("Vous devez rédiger un message !");
		} else {
			$pdo->addGymComment(Session::getUserID()[0],$content);
			header('Refresh:0');
		}
	}
	if(isset($_REQUEST['newsletterChange'])){
		if($pdo->getInscritNewsletter(Session::getUserID()[0])=="1"){
			$pdo->removeSubscription($pdo->getUserEmail(Session::getUserID()[0])['mailUtilisateur']);
			header('Location:./index.php');
		} else {
			$pdo->addSubscription($pdo->getUserEmail(Session::getUserID()[0])['mailUtilisateur']);
			header('Location:./index.php');
		}
	}
	if(isset($_REQUEST['pseudoChange'])){
		if($_REQUEST['pseudoChanged']){
			if($pdo->userExist($_REQUEST['pseudoChanged'])){
				$view->menu->setMessage("Ce pseudo existe déjà");
			} else {
				header('Location:./index.php');
				$pdo->updatePseudo($_REQUEST['pseudoChanged'], Session::getUserID()[0]);
			}
		}
	}
	if(isset($_REQUEST['emailChange'])){
		if($_REQUEST['emailChanged']){
			if(!filter_var($_REQUEST["emailChanged"],FILTER_VALIDATE_EMAIL)){
				return $view->menu->setMessage("Veuillez rentrer une adresse valide !");
			}else if($pdo->userExist($_REQUEST['emailChanged'], "mailUtilisateur")){
				return $view->menu->setMessage("Cet email existe déjà");
			} else {
				header('Location:./index.php');
				$pdo->updateEmail($_REQUEST['emailChanged'], Session::getUserID()[0]);
			}
		}
	}
?>