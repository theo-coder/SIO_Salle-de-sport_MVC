<?php
    include_once("./Views/viewMenu.php");
    
	error_reporting(E_ALL);
    ini_set("display_errors", 1);
    
	switch($action) {
		case "view" :
			include_once("./Views/viewCommentaires.php");
			$view->menu = new viewMenu();
			$view->body =  new viewCommentaires();
            $view->body->getGymComments($pdo->getGymComments());
            $view->body->getUser($pdo->getUser());
			if(isset($_REQUEST['deleteCom'])){
                $pdo->removeComment($_REQUEST['idCommentaire']);
                header('Refresh:0');
            }
        	break;
		default :
			$view->menu = new viewMenu();
			break;
	}
	
	
?>