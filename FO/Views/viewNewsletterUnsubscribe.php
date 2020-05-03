<?php 

class viewNewsLetterUnsubscribe implements viewsComponent_interface {
    public function __construct() {  
    }
	public function setMessage($message){
		$this->message = $message;
	}
	public function insideHtml(){
        $str="<div class='back'></div>
        <div class='contain'>
            <h2>Désinscription de la newsletter</h2>
            <div class='mail-input'>
                <form>
                    <input type='email' class='mail' placeholder='Veuillez rentrer votre adresse email' name='mail'>
		            <button type='submit' class='btn btn-primary'>Envoyer</button>
                    <input type='hidden' name='case' value='FO_Newsletter'>
                    <input type='hidden' name='action' value='unsubscription'>
                </form>
            </div>
        </div>
        ";
        if($this->message != null){
            $str=$str.'<div class="error"><h2>'.$this->message.'</h2></div>';
        }
        return $str;
	}
}
?>