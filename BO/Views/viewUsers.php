<?php 

class viewUsers implements viewsComponent_interface {
    private $message = null;
    public function __construct() {
    }
	public function setMessage($message){
		$this->message = $message;
    }
    public function listeInscrits($inscrits){
        $this->inscrits = $inscrits;
    }
	public function insideHtml(){
        $str="
        <div class='BO-back'></div>
        <div class='accountContain'>
            <h2>Liste des utilisateurs</h2>
            <div class='accountContainer'>

                    <table class='table'>
                        <thead>
                            <tr>
                                <th scope='col'>#</th>
                                <th scope='col'>Pseudo</th>
                                <th scope='col'>Nom</th>
                                <th scope='col'>Prénom</th>
                                <th scope='col'>Email</th>
                                <th scope='col'>Accès BO</th>
                                <th scope='col'>Admin BO</th>
                                <th scope='col'>Valider ?</th>
                            </tr>
                        </thead>
                        <tbody>";
                            for($i=0;$i<count($this->inscrits);$i++){
                                    $str.="
                                    <form method='post'>
                                        <tr>
                                            <th scope='row'>".$this->inscrits[$i]['idUtilisateur']."</th>
                                                <td><input type='text'";if($this->inscrits[$i]['idUtilisateur']==Session::getUserID()[0]){$str.=" disabled ";}$str.=" class='form-control' name='pseudo' placeholder='".$this->inscrits[$i]['pseudo']."'></input></td>
                                                <td>";
                                                    if($this->inscrits[$i]['nom']){ 
                                                        $str.="<input class='form-control'";if($this->inscrits[$i]['idUtilisateur']==Session::getUserID()[0]){$str.=" disabled ";}$str.=" type='text' name='nom' placeholder='".$this->inscrits[$i]['nom']."'></input>";
                                                    } else { 
                                                        $str.="<input type='text' ";if($this->inscrits[$i]['idUtilisateur']==Session::getUserID()[0]){$str.=" disabled ";}$str.="class='form-control' name='nom' placeholder='none'></input>";
                                                    };
                                                $str.="</td>
                                                <td>";
                                                if($this->inscrits[$i]['prenom']){ 
                                                    $str.="<input type='text' ";if($this->inscrits[$i]['idUtilisateur']==Session::getUserID()[0]){$str.=" disabled ";}$str.="class='form-control' name='prenom' placeholder='".$this->inscrits[$i]['prenom']."'></input>";
                                                } else { 
                                                    $str.="<input type='text'";if($this->inscrits[$i]['idUtilisateur']==Session::getUserID()[0]){$str.=" disabled ";}$str.=" class='form-control' name='prenom' placeholder='none'></input>";
                                                };
                                                $str.="</td>
                                                <td><input type='text' ";if($this->inscrits[$i]['idUtilisateur']==Session::getUserID()[0]){$str.=" disabled ";}$str.="class='form-control' name='email' placeholder='".$this->inscrits[$i]['mailUtilisateur']."'></input></td>
                                                <td><input type='checkbox' ";if($this->inscrits[$i]['idUtilisateur']==Session::getUserID()[0]||$this->inscrits[$i]['typeUtilisateur']=="2"){$str.=" disabled ";}$str.="name='BOUser'";
                                                if($this->inscrits[$i]['typeUtilisateur']!="0"){
                                                   $str.=" checked ";
                                                }
                                                $str.="> BO</td>
                                                <td><input type='checkbox' ";if($this->inscrits[$i]['idUtilisateur']==Session::getUserID()[0]||$this->inscrits[$i]['typeUtilisateur']=="0"){$str.=" disabled ";}$str.="name='adminUser'";
                                                if($this->inscrits[$i]['typeUtilisateur']=="2"){
                                                   $str.=" checked ";
                                                }
                                                $str.="> admin</td>
                                                <input type='hidden' name='id' value='".$this->inscrits[$i]['idUtilisateur']."'></input>
                                                <td><button type='submit' ";if($this->inscrits[$i]['idUtilisateur']==Session::getUserID()[0]){$str.=" disabled ";}$str.="class='btn btn-secondary' name='valider'>Valider</button></td>
                                        </tr>
                                    </form>
                                    ";
                                }
                        $str.="
                        </tbody>
                    </table>
            </div>
        </div>";
        if($this->message != null){
            $str=$str.'<div class="error"><h2>'.$this->message.'</h2></div>';
        }
        return $str;
	}
}
?>