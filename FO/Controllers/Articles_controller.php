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
            $view->body->getArticles($pdo->getArticlesById($_GET["view"]));

            if(isset($_REQUEST["categSubmit"])){
                if($_REQUEST["categName"]){
                    $pdo->addCateg($_REQUEST["categName"]);
                    header("Location:index.php?case=FO_Articles&action=view&view=1");
                } else {
                    $view->body->setMessage("Veuillez rentrer un nom de catégorie");
                }
            }

            if(isset($_GET['rename']))
            {
                $pdo->editCateg($_GET['view'],$_GET["rename"]);
                header("Location:index.php?case=FO_Articles&action=view&view=".$_GET['view']);
            }

            if(isset($_GET['remove']))
            {
                $pdo->removeCateg($_GET['view']);
                header("Location:index.php?case=FO_Articles&action=view");
            }
            break;

        default :
        $view->menu = new viewMenu();
        break;
    }   
	
?>