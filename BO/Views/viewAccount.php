<?php 

class viewAccount implements viewsComponent_interface {
    public function __construct() {  
    }
    public function getUserPseudo($pseudo){
		$this->pseudo=$pseudo['pseudo'];
	}
    public function getUserEmail($email){
		$this->email=$email['mailUtilisateur'];
	}
	public function setMessage($message){
		$this->message = $message;
    }
    public function getUserName($name){
		$this->name=$name['nom'];
	}
    public function getUserFirstname($firstname){
		$this->firstname=$firstname['prenom'];
	}
    public function getUserGender($gender){
        if($gender['genre']=='H'){
            $this->gender=1;
        } else if($gender['genre']=='F'){
            $this->gender=2;
        } else {
            $this->gender=0;
        }
	}
    public function getNewsletterInscrit($val){
        $val=="1"?$this->newsletter=1:$this->newsletter=0;
	}
	public function insideHtml(){
        $str="<div class='back'></div>
        <div class='accountContain'>
            <h2 class='accountTitle'>Mon compte</h2>
                <form method='POST' class='accountForm'>

                    <label for='pseudoInput' class='accountLabel accountLabelPseudo'>Pseudo :</label>
                    <input type='text' placeholder='".$this->pseudo."' name='pseudo' id='pseudoInput' class='accountInputPseudo accountInput'>
                    <label for='emailInput' class='accountLabel accountLabelEmail'>Email :</label>
                    <input type='text' placeholder='".$this->email."' name='email' id='emailInput' class='accountInputEmail accountInput'>
                    <label for='newsletterInput' class='accountLabel accountLabelNewsletter'>Newsletter :</label>
                    <select name='newsletter' id='newsletterInput' class='accountInputNewsletter accountInput'>";
                    switch ($this->newsletter) {
                        case 1:
                            $str.="<option selected value='1'>On</option>
                            <option value='0'>Off</option>";
                            break;
    
                        default:
                            $str.="<option value='1'>On</option>
                            <option selected value='0'>Off</option>";
                            break;
                    }
                        
                    $str.="</select>
                    <label for='nameInput' class='accountLabel accountLabelName'>Nom :</label>
                    <input type='text' placeholder='".$this->name."' name='name' id='nameInput' class='accountInputName accountInput'>
                    <label for='firstnameInput' class='accountLabel accountLabelfirstname'>Prénom :</label>
                    <input type='text' placeholder='".$this->firstname."' name='firstname' id='firstnameInput' class='accountInputFirstname accountInput'>
                    <label for='genderInput' class='accountLabel accountLabelGender'>Genre :</label>
                    <select name='gender' id='genderInput' class='accountInputGender accountInput'>";
                    switch ($this->gender) {
                        case 1:
                            $str.="<option selected value='1'>M.</option>
                            <option value='2'>Mme.</option>";
                            break;
                        case 2:
                            $str.="<option value='1'>M.</option>
                            <option selected value='2'>Mme.</option>";
                            break;
                        default:
                            $str.="<option selected value='1'>M.</option>
                            <option value='2'>Mme.</option>";
                            break;
                    }
                        
                    $str.="</select>
                    <label for='passInput' class='accountLabel accountLabelPass'>Mot de passe :</label>
                    <input type='password' placeholder='Password' name='pass' id='passInput' class='accountInputPass accountInput'>
                    <input type='password' placeholder='Password verification' name='passVerify' id='passInputVerify' class='accountInputPassVerify accountInput'>
                    <a href='index.php' class='btn btn-danger'>Retour</a>
                    <button name='accountSubmit' type='submit' class='btn btn-primary'>Envoyer</button>
                    <a class'btn btn-danger' href='index.php?case=BO_Delete'>Supprimer le compte</a>
                </form>
        </div>";
        if($this->message != null){
            $str=$str.'<div class="error"><h2>'.$this->message.'</h2></div>';
        }
        return $str;
	}
}
?>