<?php 

class viewArticlesEdit implements viewsComponent_interface {
    private $message = null;
    public function __construct($article) { 
        $this->article = $article;
    }
	public function setMessage($message){
		$this->message = $message;
    }
	public function getCategories($categories){
        $this->categorie = $categories;
    }
	public function insideHtml(){
        $str="
        <div class='back'></div>
                <div class='accountContainArticles'>
                    <h2 class='accountTitle'>Modification d'un article</h2>
                    <form method='POST' enctype='multipart/form-data' class='accountForm needs-validation' novalidate>
                        <label for='pseudoInput' class='accountLabel accountLabelPseudo'>Titre :</label>
                        <input type='text' value='".$this->article[0]['titre']."' name='title' id='pseudoInput' class='accountInputPseudo accountInput form-control' required>
                        <label for='emailInput' class='accountLabel accountLabelEmail'>Image :</label>
                        <input type='file' accept='image/jpeg,image/tiff,image/gif,image/x-png' name='picture'>
                        <label for='newsletterInput' class='accountLabel accountLabelNewsletter'>Catégorie :</label>
                        <select name='category' id='newsletterInput' class='accountInputNewsletter accountInput form-control' required>";
                            foreach($this->categorie as $categorie)
                            {
                                if($this->article[0]['idCategorie'] == $categorie['idCategorie'])
                                {
                                    $str .= "<option selected value='".$categorie['idCategorie']."'>".$categorie['titre']."</option>";
                                }else{
                                    $str .= "<option value='".$categorie['idCategorie']."'>".$categorie['titre']."</option>";
                                }

                            }
                      
                        $str.="</select>
                        <div class='summernote' style='text-align: left;'>
                            <textarea id='summernote' rows='5' name='texte' required>".$this->article[0]['texteHtml']."</textarea>
                        </div>
                        <button name='articleSubmit' type='submit' class='btn btn-primary btnArticles'>Envoyer</button>
                    </form>
                </div>";
                if($this->message != null){
                    $str=$str.'<div class="error"><h2>'.$this->message.'</h2></div>';
                }
                return $str;
        }
        
	}
?>