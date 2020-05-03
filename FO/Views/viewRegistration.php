<?php 

class viewRegistration implements viewsComponent_interface {
    private $message = null;
    public function __construct() {  
    }
	public function setMessage($message){
		$this->message = $message;
	}
	public function insideHtml(){
        $str="<div class='back'></div>
        <div class='contain'>
            <h2>S'inscrire</h2>
            <div class='registration-input'>
                <form method='POST'>
                    <input type='text' class='pseudo' placeholder='Veuillez rentrer un pseudo' name='pseudo'>
                    <input type='email' class='email' placeholder='Veuillez rentrer une adresse mail' name='email'>
                    <input type='password' class='password' placeholder='Veuillez rentrer un mot de passe' name='password'>
                    <input type='password' class='password' placeholder='Veuillez confirmer votre mot de passe' name='password-verif'>
                    <button type='submit' class='btn btn-primary'>Envoyer</button>
                    <br>
                    <a href='index.php?case=FO_Registration&action=connexion'>Déjà inscrit ? se connecter</a>
                    <input type='hidden' name='case' value='FO_Registration'>
                    <input type='hidden' name='action' value='registration'>
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