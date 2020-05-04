<?php
    include_once("./Views/viewMenu.php");
	switch($action) {
		case "view" :
			include_once("./Views/viewAbonnements.php");
			$view->menu = new viewMenu();
			$view->body =  new viewAbonnements();
			

            switch($_GET["view"]){
                case "all":
                    $view->body->getAbonnements($pdo->getAllAbonnements());
                break;
                case "noabo":
                    $view->body->getAbonnements($pdo->listeNoAbo());
                break;
                case "valid":
                    $view->body->getAbonnements($pdo->listeValid());
                break;
                case "done":
                    $view->body->getAbonnements($pdo->listeDone());
                break;
            }

            
            
        	break;
		default :
			$view->menu = new viewMenu();
			break;
	}
	
	
?>