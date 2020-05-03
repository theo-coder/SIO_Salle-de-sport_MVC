<?php
	include_once("./Views/viewMenu.php");
    include_once("./Views/viewArticles.php");
    
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	
	switch($action) {

		case "view" :
			
			$view->menu =  new viewMenu();
			$view->body =  new viewArticles();
            $view->body->getCategories($pdo->getCategories());
            
            if(isset($_REQUEST["categSubmit"])){
                if($_REQUEST["categName"]){
                    $pdo->addCateg($_REQUEST["categName"]);
                } else {
                    $view->body->setMessage("Veuillez rentrer un nom de catégorie");
                }
            }
            //header("Location:index.php?case=BO_Articles&action=view");
            break;

		default :
			$view->menu = new viewMenu();
			break;
	}
	
	
?>