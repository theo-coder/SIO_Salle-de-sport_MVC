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
            $view->body->getCategories($pdo->getCategories());

            if(isset($_REQUEST['articleSubmit'])){
				$titre = $_REQUEST['title'];
				$image = $_FILES['picture'];
				$categorie = $_REQUEST['category'];
                $texte = $_REQUEST['texte'];
                $user = Session::getUserID()[0];
                // Un gros check bien dégueulasse parce que flemme
                if($titre && $categorie && $texte)
                {
                    if (isset($image))
                    {
                        $content_dir = './Tools/articles/';
                        $tmp_file = $image['tmp_name'];
                        if(!is_uploaded_file($tmp_file)){
                            echo("Le fichier est introuvable");
                        }
                        $type_file = $image['type'];
                        if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') && !strstr($type_file, 'png')){
                            echo("Le fichier n'est pas une image");
                        }
                        $name_file = uniqid() . '.' . end(explode(".", $image["name"]));
                
                        if(!move_uploaded_file($tmp_file, $content_dir . $name_file)){
                            echo("Impossible de copier le fichier dans $content_dir");
                        }
                    }else{
                        $name_file="";
                    }
                    $pdo->addArticle($titre,$name_file,$texte,$user,$categorie);

                }else $view->body->setMessage("Veuillez vérifier votre mot de passe !");

                var_dump($image);

				header('Location:?case=BO_Articles&action=view&view=1');
			}

            
        break;

        default :
        $view->menu = new viewMenu();
        break;
    }   
	
?>