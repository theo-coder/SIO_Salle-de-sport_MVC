<?php 

class viewArticlesAdd implements viewsComponent_interface {
    private $message = null;
    public function __construct() {  
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
                    <h2 class='accountTitle'>Ajout d'un article</h2>
                    <form method='POST' class='accountForm needs-validation' novalidate>
                        <label for='pseudoInput' class='accountLabel accountLabelPseudo'>Titre :</label>
                        <input type='text' placeholder='' name='title' id='pseudoInput' class='accountInputPseudo accountInput form-control' required>
                        <div class='invalid-feedback'>Veuillez insérer un titre</div>
                        <label for='emailInput' class='accountLabel accountLabelEmail'>Image :</label>
                        <div class='invalid-feedback'>Veuillez insérer une image</div>
                        <input type='text' placeholder='' name='image' id='emailInput' class='accountInputEmail accountInput form-control' required>
                        <label for='newsletterInput' class='accountLabel accountLabelNewsletter'>Catégorie :</label>
                        <select name='category' id='newsletterInput' class='accountInputNewsletter accountInput form-control' required>
                            <option value='' selected>Choisissez une catégorie...</option>";
                            foreach($this->categorie as $categorie)
                            {
                                $str .= "<option value='".$categorie['idCategorie']."'>".$categorie['titre']."</option>";

                            }
                      
                        $str.="</select>
                        <div class='invalid-feedback'>Veuillez choisir une catégorie</div>
                        <div class='summernote' style='text-align: left;'>
                            <textarea id='summernote' rows='5' name='texte' required></textarea>
                        </div>
                        <button name='accountSubmit' type='submit' class='btn btn-primary btnArticles'>Envoyer</button>
                    </form>
                </div>";
                if($this->message != null){
                    $str=$str.'<div class="error"><h2>'.$this->message.'</h2></div>';
                }
                return $str;
        }
        
	}
?>