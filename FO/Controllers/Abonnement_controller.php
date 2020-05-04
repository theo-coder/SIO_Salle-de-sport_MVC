<?php
    include_once("./Views/viewMenu.php");
    
	switch($action) {

		case "subscribe" :
			$view->menu = new viewMenu();
            if($pdo->getUserAbonnement(Session::getUserID()[0])){
                include_once("./Views/viewCurrentAbonnement.php");
                $view->body = new viewCurrentAbonnement();
                $view->body->userAbo($pdo->getUserAbonnement(Session::getUserID()[0]));
                $view->body->userAboDate($pdo->getUserAbonnementDate(Session::getUserID()[0]));

            } else {
                include_once("./Views/viewAbonnementSubscribe.php");
                $view->body =  new viewAbonnementSubscribe();
            }
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
                            $dateFin = date('Y-m-d',strtotime('+1 months'));
                            $pdo->addAbonnement(Session::getUserID()[0], $payement, $dateFin, "D");
                            header('Location:./index.php');
                        break;
                        case 2:
                            //six mois
                            $id = Session::getUserID()[0];
                            $payement = 'P';
                            $dateFin = date('Y-m-d',strtotime('+6 months'));
                            $pdo->addAbonnement(Session::getUserID()[0], $payement, $dateFin, "F");
                            header('Location:./index.php');
                        break;
                        case 3:
                            //un an
                            $id = Session::getUserID()[0];
                            $payement = 'P';
                            $dateFin = date('Y-m-d',strtotime('+12 months'));
                            $pdo->addAbonnement(Session::getUserID()[0], $payement, $dateFin, "M");
                            header('Location:./index.php');
                        break;
                    }
                } else {
                    $view->body->setMessage("Veuillez choisir une durée");
                }
            }
            break;
		
		default :
			$view->menu = new viewMenu();
			break;
	}
	
	
?>