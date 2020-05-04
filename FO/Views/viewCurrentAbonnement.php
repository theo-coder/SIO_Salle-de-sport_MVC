<?php 

class viewCurrentAbonnement implements viewsComponent_interface {
    private $message = null;
    public function __construct() {  
    }
	public function setMessage($message){
		$this->message = $message;
    }
    public function userAbo($abo){
        $this->abonnement = $abo['typeAbonnement'];
    }
    public function userAboDate($abo){
        $this->date = date("d/m/Y",strtotime($abo['dateFin']));
    }
	public function insideHtml(){
        $str='<div class="back"></div>
                <div class="accountContain">
                    <h2>Abonnement en cours</h2>';
                    switch($this->abonnement){
                        case "D":
                            //decouverte
                            $type="Découverte";
                            $description="Grâce à la formule découverte
                            venez découvrir l'ambiance
                            d'entre-haltères durant
                            une journée et le tout
                            gratuitement !";
                            break;
                        case "F":
                            //forme
                            $type="Forme";
                            $description="Grâce à la formule forme
                            renouvelable chaque mois
                            vous pourrez disposer
                            de tout notre matériel au
                            plus bas prix !";
                            break;
                        case "M":
                            //musclor
                            $type="Musclor";
                            $description="Grâce à la formule musclor
                            disposez de tout notre matériel
                            ainsi que de l'avis et des
                            conseil de nos experts
                            au plus bas prix !";
                            break;
                        default:
                            echo("Erreur");
                            break;
                    }
                    $str.="
                    <div class='card' style='width: 18rem;'>
                    <div class='card-body'>
                        <h5 class='card-title'>".$type."</h5>
                        <p class='card-text'>".$description."</p>
                        <h6>Jusqu'au ".$this->date."</h6>
                    </div>
                    <a href='index.php?case=FO_DeleteAbo' class='btn btn-danger'>Supprimer</a>
                </div>
                    ";
            $str.='</div>';
        if($this->message != null){
            $str=$str.'<div class="error"><h2>'.$this->message.'</h2></div>';
        }
        return $str;
	}
}
?>