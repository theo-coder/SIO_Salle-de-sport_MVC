<?php
    include_once("./Views/viewMenu.php");
	switch($action) {
		case "view" :
			include_once("./Views/viewAbonnements.php");
			$view->menu = new viewMenu();
            $view->body =  new viewAbonnements();
            $view->body->getAbonnements($pdo->getAllAbonnements());
            
        	break;
		default :
			$view->menu = new viewMenu();
			break;
	}
	
	
?>