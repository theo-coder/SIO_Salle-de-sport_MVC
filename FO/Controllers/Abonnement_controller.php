<?php
    include_once("./Views/viewMenu.php");
    
	switch($action) {

		case "subscribe" :
			include_once("./Views/viewAbonnementSubscribe.php");
			$view->menu = new viewMenu();
            $view->body =  new viewAbonnementSubscribe();
            break;
        
        case "subscription":
			include_once("./Views/viewAbonnementSubscription.php");
			$view->menu = new viewMenu();
            $view->body =  new viewAbonnementSubscription();

            if(isset($_REQUEST['payement'])){
                
                if(trim($_REQUEST['selection'])!="Durée"){
                    switch($_REQUEST['selection']){
                        case 1:
                            //un mois
                            $id = Session::getUserID()[0];
                            $payement = 'P';
                            
                        break;
                        case 2:
                            //six mois
                            $id = Session::getUserID()[0];
                            $payement = 'P';
                        break;
                        case 3:
                            //un an
                            $id = Session::getUserID()[0];
                            $payement = 'P';
                        break;
                    }
                } else {
                    $view->body->setMessage("Veuillez choisir une durée");
                }
            }
            break;
		// case "subscription" :
			// include_once("./Views/viewNewsletterSubscribe.php");
			// $view->menu = new viewMenu();
			// $view->body =  new viewNewsletterSubscribe();
			// if(($_REQUEST["mail"]!="") && ($_REQUEST["name"]!="") && ($_REQUEST["firstName"]!="") && ($_REQUEST["gender"]!="")) {
			// 	if($pdo->addSubscription($_REQUEST["mail"], $_REQUEST["name"], $_REQUEST["firstName"], $_REQUEST["gender"])) {
			// 		$view->body->setMessage("Inscription réussie");
			// 	} else {
			// 		$view->body->setMessage("Erreur 500");
			// 	}
			// }else{
			// 	$view->body->setMessage("Veuillez tout remplir !");
			// }
		// break;

		// case "unsubscribe" :
		// 	include_once("./Views/viewAbonnementUnsubscribe.php");
		// 	$view->menu = new viewMenu();
		// 	$view->body =  new viewAbonnementUnsubscribe();
        // break;
        
		// case "unsubscription" :
		// 	include_once("./Views/viewNewsletterUnsubscribe.php");
		// 	$view->menu = new viewMenu();
        //     $view->body =  new viewNewsletterUnsubscribe();
            
		// 	if($_REQUEST["mail"]!="") {
		// 		if($pdo->removeSubscription($_REQUEST["mail"])){
		// 			$view->body->setMessage("Désinscription réussie");
		// 		}else{
		// 			$view->body->setMessage("Erreur 500");
		// 		}
		// 	}else{
		// 		$view->body->setMessage("Mail non saisi !");
		// 	}		
		// break;
		
		default :
			$view->menu = new viewMenu();
			break;
	}
	
	
?>