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
                    <form method='POST' class='accountForm'>
                        <label for='pseudoInput' class='accountLabel accountLabelPseudo'>Titre :</label>
                        <input type='text' placeholder='' name='title' id='pseudoInput' class='accountInputPseudo accountInput'>
                        <label for='emailInput' class='accountLabel accountLabelEmail'>Image :</label>
                        <input type='text' placeholder='' name='image' id='emailInput' class='accountInputEmail accountInput'>
                        <label for='newsletterInput' class='accountLabel accountLabelNewsletter'>Catégorie :</label>
                        <select name='category' id='newsletterInput' class='accountInputNewsletter accountInput'>";
                            // switch ($this->newsletter) {
                            //     case 1:
                            //         $str.="<option selected value='1'>On</option>
                            //         <option value='0'>Off</option>";
                            //         break;
            
                            //     default:
                            //         $str.="<option value='1'>On</option>
                            //         <option selected value='0'>Off</option>";
                            //         break;
                            // }
                      
                        $str.="</select>
                        <div class='summernote'>
                            <textarea id='summernote' name='texte'></textarea>
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