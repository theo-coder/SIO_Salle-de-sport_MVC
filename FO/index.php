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

if(isset($_REQUEST["case"]))
    $case = $_REQUEST["case"];
else
	$case = "FO_Home";

switch($case){
	case "FO_Newsletter":
		include "./Controllers/NewsLetter_controller.php";
		break;
	case "FO_Registration":
		if(Session::isLogged()){
			header('Location:./index.php');
		}
		include "./Controllers/User_controller.php";
		break;
	case "FO_Disconnect":
		Session::removeUser();
		include_once("./Views/viewHomeMenu.php");
		$view->menu = new viewHomeMenu();
		include_once("./Views/viewHome.php");
		$view->body = new viewHome();
		break;
	case "FO_Delete":
		$pdo->deleteUser(Session::getUserID()[0]);
		Session::removeUser();
		include_once("./Views/viewHomeMenu.php");
		$view->menu = new viewHomeMenu();
		include_once("./Views/viewHome.php");
		$view->body = new viewHome();
		break;
	case "FO_Abonnement":
		include "./Controllers/Abonnement_controller.php";
		break;
	case "FO_Account":
		include "./Controllers/Account_controller.php";
		break;
	default :
		include "./Controllers/Home_controller.php";
		break;
}
echo $view->html();
?>