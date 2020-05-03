<?php 

class viewConnexion implements viewsComponent_interface {
    public function __construct() {  
    }
	public function setMessage($message){
		$this->message = $message;
	}
	public function insideHtml(){
        $str="<div class='back'></div>
        <div class='contain'>
            <h2>Se connecter</h2>
            <div class='registration-input'>
                <form method='POST'>
                    <input type='text' class='pseudo' placeholder='Veuillez rentrer votre pseudo ou votre adresse email' name='pseudo'>
                    <input type='password' class='password' placeholder='Veuillez rentrer votre mot de passe' name='password'>
                    <button type='submit' class='btn btn-primary'>Envoyer</button>
                    <br>
                    <a href='index.php?case=FO_Registration&action=register'>Pas encore inscrit ? s'inscrire</a>
                    <input type='hidden' name='case' value='FO_Registration'>
                    <input type='hidden' name='action' value='connect'>
                </form>
            </div>
        </div>";
        if($this->message != null){
            $str=$str.'<div class="error"><h2>'.$this->message.'</h2></div>';
        }
        return $str;
	}
}
?>