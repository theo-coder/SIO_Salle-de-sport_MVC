<?php 

class viewAbonnements implements viewsComponent_interface {
    private $message = null;
    public function __construct() {  
    }
	public function setMessage($message){
		$this->message = $message;
    }
    public function getAbonnements($abos){
        $this->abonnements = $abos;
    }
	public function insideHtml(){
        $str="<div class='back'></div>
        <div class='accountContain'>
        <ul class='nav justify-content-center navCateg'>

                <li class='nav-item navCategItem'>
                    <a href='?case=BO_Abonnements&action=view&view=all' class='btn btn-primary'>Tous les abonnés</a>
                </li>
                <li class='nav-item navCategItem'>
                    <a href='?case=BO_Abonnements&action=view&view=noabo' class='btn btn-primary'>Inscrits sans abonnements</a>
                </li>
                <li class='nav-item navCategItem'>
                    <a href='?case=BO_Abonnements&action=view&view=valid' class='btn btn-primary'>Abonnements valide</a>
                </li>
                <li class='nav-item navCategItem'>
                    <a href='?case=BO_Abonnements&action=view&view=done' class='btn btn-primary'>Abonnements finis</a>
                </li>
        </ul>
            <table class='table'>
                <thead>
                    <tr>
                        <th scope='col'>#</th>
                        <th scope='col'>Pseudo</th>
                        <th scope='col'>Email</th>
                        <th scope='col'>État Paiement</th>
                        <th scope='col'>Date début</th>
                        <th scope='col'>Date fin</th>
                        <th scope='col'>Validité</th>
                        <th scope='col'>Type Abonnement</th>
                    </tr>
                </thead>
                <tbody>";

                foreach($this->abonnements as $abo){
                    $str.="<tr>
                        <th scope='row'>".$abo['idUtilisateur']."</th>
                        <td>".$abo['pseudo']."</td>
                        <td>".$abo['mailUtilisateur']."</td>
                        <td>".$abo['etatPaiement']."</td>
                        <td>".$abo['dateDebut']."</td>
                        <td>".$abo['dateFin']."</td>
                        <td>";
                        if($abo['dateFin']>date("Y-m-d")){
                            $validite=true;
                        } else {
                            $validite=false;
                        }
                        $str.=$validite."</td>
                        <td>".$abo['typeAbonnement']."</td>
                    </tr>";
                }
                $str.="</tbody>
            </table>
        </div>";
        if($this->message != null){
            $str=$str.'<div class="error"><h2>'.$this->message.'</h2></div>';
        }
        return $str;
	}
}
?>