<?php
	include_once("./Views/viewMenu.php");
    include_once("./Views/viewArticles.php");
    include_once("./Views/viewArticlesAdd.php");
    include_once("./Views/viewArticlesEdit.php");

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

            if(isset($_GET['rename']))
            {
                $pdo->editCateg($_GET['view'],$_GET["rename"]);
                header("Location:index.php?case=BO_Articles&action=view&view=".$_GET['view']);
            }

            if(isset($_GET['remove']))
            {
                $pdo->removeCateg($_GET['view']);
                header("Location:index.php?case=BO_Articles&action=view");
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

				header('Location:?case=BO_Articles&action=view&view=1');
			}

            
        break;

        case "edit" :
            
            if(!isset($_GET['article']))
            {
                http_response_code(404);
                die("<h1>L'article a éditer n'a pas été spécifié.</h1>");
            }
            $article = $pdo->getArticleData($_GET['article']);
            
			$view->menu =  new viewMenu();
			$view->body =  new viewArticlesEdit($article);
            $view->body->getCategories($pdo->getCategories());

            if(isset($_REQUEST['articleSubmit'])){
				$titre = $_REQUEST['title'];
				$image = $_FILES['picture'];
				$categorie = $_REQUEST['category'];
                $texte = $_REQUEST['texte'];
                $user = Session::getUserID()[0];

                var_dump($pdo->getArticleData($_GET['article'])[0]['imageArticle']);

                // Un gros check bien dégueulasse parce que flemme
                if($titre && $categorie && $texte)
                {
                    if (is_uploaded_file($image['tmp_name']))
                    {
                        if($pdo->getArticleData($_GET['article'])[0]['imageArticle'] != "")
                        {
                            unlink("./Tools/articles/".$pdo->getArticleData($_GET['article'])[0]['imageArticle']);
                        }
                        $content_dir = './Tools/articles/';
                        $tmp_file = $image['tmp_name'];
                        $type_file = $image['type'];
                        if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') && !strstr($type_file, 'png')){
                            echo("Le fichier n'est pas une image");
                        }
                        $ext = explode(".", $image["name"]);
                        $name_file = uniqid() . '.' . end($ext);
                
                        if(!move_uploaded_file($tmp_file, $content_dir . $name_file)){
                            echo("Impossible de copier le fichier dans $content_dir");
                        }
                    }else{
                        $name_file=$pdo->getArticleData($_GET['article'])[0]['imageArticle'];
                    }
                    $pdo->editArticle($_GET['article'], $titre,$name_file,$texte,$user,$categorie);

                }else $view->body->setMessage("Des champs sont manquants");

				header('Location:?case=BO_Articles&action=view&view=1');
			}

            
        break;

        case "edit" :
            
            if(!isset($_GET['article']))
            {
                http_response_code(404);
                die("<h1>L'article a éditer n'a pas été spécifié.</h1>");
            }
            $article = $pdo->getArticleData($_GET['article']);
            
			$view->menu =  new viewMenu();
			$view->body =  new viewArticlesEdit($article);
            $view->body->getCategories($pdo->getCategories());

            if(isset($_REQUEST['articleSubmit'])){
				$titre = $_REQUEST['title'];
				$image = $_FILES['picture'];
				$categorie = $_REQUEST['category'];
                $texte = $_REQUEST['texte'];
                $user = Session::getUserID()[0];

                var_dump($pdo->getArticleData($_GET['article'])[0]['imageArticle']);

                // Un gros check bien dégueulasse parce que flemme
                if($titre && $categorie && $texte)
                {
                    if (is_uploaded_file($image['tmp_name']))
                    {
                        if($pdo->getArticleData($_GET['article'])[0]['imageArticle'] != "")
                        {
                            unlink("./Tools/articles/".$pdo->getArticleData($_GET['article'])[0]['imageArticle']);
                        }
                        $content_dir = './Tools/articles/';
                        $tmp_file = $image['tmp_name'];
                        $type_file = $image['type'];
                        if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') && !strstr($type_file, 'png')){
                            echo("Le fichier n'est pas une image");
                        }
                        $ext = explode(".", $image["name"]);
                        $name_file = uniqid() . '.' . end($ext);
                
                        if(!move_uploaded_file($tmp_file, $content_dir . $name_file)){
                            echo("Impossible de copier le fichier dans $content_dir");
                        }
                    }else{
                        $name_file=$pdo->getArticleData($_GET['article'])[0]['imageArticle'];
                    }
                    $pdo->editArticle($_GET['article'], $titre,$name_file,$texte,$user,$categorie);

                }else $view->body->setMessage("Des champs sont manquants");

				header('Location:?case=BO_Articles&action=view&view=1');
			}

            
        break;

        case "edit" :
            
            if(!isset($_GET['article']))
            {
                http_response_code(404);
                die("<h1>L'article a éditer n'a pas été spécifié.</h1>");
            }
            $article = $pdo->getArticleData($_GET['article']);
            
			$view->menu =  new viewMenu();
			$view->body =  new viewArticlesEdit($article);
            $view->body->getCategories($pdo->getCategories());

            if(isset($_REQUEST['articleSubmit'])){
				$titre = $_REQUEST['title'];
				$image = $_FILES['picture'];
				$categorie = $_REQUEST['category'];
                $texte = $_REQUEST['texte'];
                $user = Session::getUserID()[0];

                var_dump($pdo->getArticleData($_GET['article'])[0]['imageArticle']);

                // Un gros check bien dégueulasse parce que flemme
                if($titre && $categorie && $texte)
                {
                    if (is_uploaded_file($image['tmp_name']))
                    {
                        if($pdo->getArticleData($_GET['article'])[0]['imageArticle'] != "")
                        {
                            unlink("./Tools/articles/".$pdo->getArticleData($_GET['article'])[0]['imageArticle']);
                        }
                        $content_dir = './Tools/articles/';
                        $tmp_file = $image['tmp_name'];
                        $type_file = $image['type'];
                        if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') && !strstr($type_file, 'png')){
                            echo("Le fichier n'est pas une image");
                        }
                        $ext = explode(".", $image["name"]);
                        $name_file = uniqid() . '.' . end($ext);
                
                        if(!move_uploaded_file($tmp_file, $content_dir . $name_file)){
                            echo("Impossible de copier le fichier dans $content_dir");
                        }
                    }else{
                        $name_file=$pdo->getArticleData($_GET['article'])[0]['imageArticle'];
                    }
                    $pdo->editArticle($_GET['article'], $titre,$name_file,$texte,$user,$categorie);

                }else $view->body->setMessage("Des champs sont manquants");

				header('Location:?case=BO_Articles&action=view&view='.$_GET['view']);
			}

            
        break;

        case "remove" :
            
            if(!isset($_GET['article']))
            {
                http_response_code(404);
                die("<h1>L'article a éditer n'a pas été spécifié.</h1>");
            }
            $article = $pdo->getArticleData($_GET['article']);          
            unlink("./Tools/articles/".$pdo->getArticleData($_GET['article'])[0]['imageArticle']);
            $pdo->removeArticle($_GET['article']);

            header('Location:?case=BO_Articles&action=view&view='.$_GET['view']);
            
        break;

        default :
        $view->menu = new viewMenu();
        break;
    }   
	
?>