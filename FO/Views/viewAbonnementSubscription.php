<?php 

class viewAbonnementSubscription implements viewsComponent_interface {
    private $message = null;
    public function __construct() {  
    }
	public function setMessage($message){
		$this->message = $message;
    }
	public function insideHtml(){
        $str='<div class="back"></div>
        <div class="accountContain">';

        // C'est pas beau mais j'ai plus trop le temps
            switch($_GET["type"]){
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
                        <form method='post'>
                            <select class='custom-select custom-select-lg mb-3'>
                                <option selected hidden>Durée</option>
                                <option value='1'>Un mois</option>
                                <option value='2'>Six mois</option>
                                <option value='3'>Un an</option>
                            </select>
                            <button type='submit' name='payement' class='btn btn-primary'>Simuler payement</button>
                        </form>
                    </div>
                </div>
                

               
               </div>";
        if($this->message != null){
            $str=$str.'<div class="error"><h2>'.$this->message.'</h2></div>';
        }
        return $str;
	}
}
?>