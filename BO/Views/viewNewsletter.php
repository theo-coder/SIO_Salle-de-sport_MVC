<?php 

class viewNewsletter implements viewsComponent_interface {
    private $message = null;
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
    public function listeInscrits($inscrits){
        $this->inscrits=$inscrits;
    }
	public function insideHtml(){
        $str="<div class='back'></div>
        
        
            <div class='accountContain'>
            <form method='post'>
                <h2 class='accountTitle'>Newsletter</h2>
                <div class='btns'>
                    <button type='submit' name='sendButton' class='btn btn-primary'>Envoyer un message</button>
                    <a class='text-white btn btn-secondary' data-toggle='modal' data-target='#modalInscrits' >Liste des inscrits</a>
                </div>
                <div>
                    <textarea rows='10' cols='75' name='content'>
                    </textarea>
                </div>
                
                </form>
            </div>
        
        <!-- Modal -->
        <div class='modal fade' id='modalInscrits' tabindex='-1' role='dialog' aria-labelledby='modalInscritsLabel' aria-hidden='true'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='modalInscritsLabel'>Liste des inscrits</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>

                <table class='table'>
                    <thead>
                        <tr>
                            <th scope='col'>Email</th>
                            <th scope='col'>Prénom</th>
                            <th scope='col'>Nom</th>
                            <th scope='col'>Genre</th>
                        </tr>
                    </thead>
                    <tbody>";

                    for($i=0;$i<count($this->inscrits);$i++){
                        $str.="
                        <tr>
                            <th scope='row'>".$this->inscrits[$i]['mail']."</th>
                            <td>".$this->inscrits[$i]['prenom']."</td>
                            <td>".$this->inscrits[$i]['nom']."</td>
                            <td>".$this->inscrits[$i]['genre']."</td>
                        </tr>
                        ";
                    }
                    $str.="</tbody>
                </table>

            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
            </div>
            </div>
        </div>
        </div>
        <script src='http://js.nicedit.com/nicEdit-latest.js' type='text/javascript'></script>
        <script type='text/javascript'>bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
        ";
        if($this->message != null){
            $str=$str.'<div class="error"><h2>'.$this->message.'</h2></div>';
        }
        return $str;
	}
}
?>