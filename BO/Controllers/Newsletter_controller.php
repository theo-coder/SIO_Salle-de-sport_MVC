<?php
	include_once("./Views/viewMenu.php");
    include_once("./Views/viewNewsletter.php");
    
    use TeissierYannis\Utils\MailSender;
	// error_reporting(E_ALL);
	// ini_set("display_errors", 1);
	
	switch($action) {
        
		case "view" :
			$view->menu =  new viewMenu();
			$view->body =  new viewNewsletter();
			
            $view->body->listeInscrits($pdo->listeInscrits());

            if(isset($_REQUEST['sendButton'])){
                $content = $_REQUEST['content'];
                if(trim($_REQUEST['content']) == ""){
                    $view->body->setMessage("Vous devez rédiger un message !");
                } else {
                    require './Models/MailSender.php';
                    $mailList = json_encode($pdo->listeInscrits(), JSON_FORCE_OBJECT);
                    MailSender::sendEmail($mailList, $content);
                }
            }
			break;

		default :
			$view->menu = new viewMenu();
			break;
	}
	
	
?>