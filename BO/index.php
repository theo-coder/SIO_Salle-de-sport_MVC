<?php
@session_start();
require("./Views/view.class.php");
require("./Views/viewsComponent.interface.php");
require("./Models/pdo.class.php");
require("./Models/session.class.php");

if(isset($_REQUEST["action"]))
	$action = $_REQUEST["action"];
else
	$action = "default";

$pdo = new PDO_SDS();
$view = new View();
if(Session::getUserType()['typeUtilisateur']=="0"){
	header('Location:../FO/index.php');
};
if(isset($_REQUEST["case"]))
    $case = $_REQUEST["case"];
else
	$case = "BO_Home";

switch($case){
	case "BO_Users":
		include "./Controllers/Users_controller.php";
		if($pdo->getUserType(Session::getUserID()[0])['typeUtilisateur']!="2"){
			header("Location:./index.php");
		}
		break;
	case "BO_Newsletter":
		include "./Controllers/Newsletter_controller.php";
		break;
	case "BO_Commentaires":
		include "./Controllers/Commentaires_controller.php";
		break;
	case "BO_Articles":
		include "./Controllers/Articles_controller.php";
		break;
	case "BO_Abonnements":
		include "./Controllers/Abonnements_controller.php";
		break;
	case "BO_Registration":
		if(Session::isLogged()){
			header('Location:./index.php');
		}
		include "./Controllers/User_controller.php";
		break;
	case "BO_Disconnect":
		Session::removeUser();
		header('Location:../FO/index.php');
		break;
	case "BO_Delete":
		$pdo->deleteUser(Session::getUserID()[0]);
		Session::removeUser();
		include_once("./Views/viewHomeMenu.php");
		$view->menu = new viewHomeMenu();
		include_once("./Views/viewHome.php");
		$view->body = new viewHome();
		break;
	case "BO_Account":
		include "./Controllers/Account_controller.php";
		break;
	default :
		include "./Controllers/Home_controller.php";
		break;
}
echo $view->html();
?>