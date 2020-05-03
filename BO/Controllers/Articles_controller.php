<?php
	include_once("./Views/viewMenu.php");
    include_once("./Views/viewArticles.php");
    include_once("./Views/viewArticlesAdd.php");
    
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	
	switch($action) {

		case "view" :
			
			$view->menu =  new viewMenu();
			$view->body =  new viewArticles();
            $view->body->getCategories($pdo->getCategories());
            $view->body->getArticles($pdo->getArticlesById($_GET["view"]));

            if(isset($_REQUEST["categSubmit"])){
                if($_REQUEST["categName"]){
                    $pdo->addCateg($_REQUEST["categName"]);
                    header("Location:index.php?case=BO_Articles&action=view");
                } else {
                    $view->body->setMessage("Veuillez rentrer un nom de catégorie");
                }
            }
            break;

		case "add" :
			
			$view->menu =  new viewMenu();
			$view->body =  new viewArticlesAdd();
            //$view->body->getCategories($pdo->getCategories());

            
            break;
        
		default :
			$view->menu = new viewMenu();
			break;
	}
	
	
?>