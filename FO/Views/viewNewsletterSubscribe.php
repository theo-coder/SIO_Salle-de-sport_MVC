<?php 

class viewNewsLetterSubscribe implements viewsComponent_interface {
    private $message = null;
    public function __construct() {  
    }
	public function setMessage($message){
		$this->message = $message;
	}
	public function insideHtml(){
        $str="<div class='back'></div>
        <div class='contain'>
            <h2>Inscription à la newsletter</h2>
            <div class='mail-input'>
                <form>
                    <input type='email' placeholder='Veuillez rentrer votre adresse email' name='mail' class='mail'>
                    <div>
                        <input type='text' placeholder='Votre nom' name='name' class='name'>
                        <input type='text' placeholder='Votre prénom' name='firstName' class='firstName'>
                    </div>
                    <div>
                        <input type='radio' id='men' name='gender' value='H' checked>
                        <label for='men'>Mr.</label>
                        <input type='radio' id='women' name='gender' value='F'>
                        <label for='men'>Mme.</label>
                    </div>
                    <button type='submit' class='btn btn-primary'>Envoyer</button>
                    <input type='hidden' name='case' value='FO_Newsletter'>
                    <input type='hidden' name='action' value='subscription'>
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