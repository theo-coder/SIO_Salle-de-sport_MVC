<?php 

class viewAbonnementSubscribe implements viewsComponent_interface {
    private $message = null;
    public function __construct() {  
    }
	public function setMessage($message){
		$this->message = $message;
    }
	public function insideHtml(){
        $str='<div class="back"></div>
        <div class="accountContain">
                <div class="pricing">
                    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
                        <h1 class="display-4">Abonnements</h1>
                        <p class="lead">Nous nous efforçons de vous garantir des abonnements adaptés à vos besoins et dans les plus bas prix.</p>
                    </div>
                    <div class="container">
                        <div class="card-deck mb-3 text-center">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header">
                                    <h4 class="my-0 font-weight-normal">Découverte</h4>
                                </div>
                                <div class="card-body">
                                    <h1 class="card-title pricing-card-title">0€<small class="text-muted"></small></h1>
                                    <ul class="list-unstyled mt-3 mb-4">
                                        <li>Grâce à la formule découverte</li>
                                        <li>venez découvrir l\'ambiance</li>
                                        <li>d\'entre-haltères durant</li>
                                        <li>une journée et le tout</li>
                                        <li>gratuitement !</li>
                                    </ul>
                                    <a href="?case=FO_Abonnement&action=subscription&type=D" class="btn btn-lg btn-block btn-outline-primary">Venez nous découvrir</a>
                                </div>
                            </div>
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header">
                                    <h4 class="my-0 font-weight-normal">Forme</h4>
                                </div>
                                <div class="card-body">
                                    <h1 class="card-title pricing-card-title">15€ <small class="text-muted">/ m</small></h1>
                                    <ul class="list-unstyled mt-3 mb-4">
                                        <li>Grâce à la formule forme</li>
                                        <li>renouvelable chaque mois</li>
                                        <li>vous pourrez disposer</li>
                                        <li>de tout notre matériel au</li>
                                        <li>plus bas prix !</li>
                                    </ul>
                                    <a href="?case=FO_Abonnement&action=subscription&type=F" class="btn btn-lg btn-block btn-primary">Commencez le travail</a>
                                </div>
                            </div>
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header">
                                    <h4 class="my-0 font-weight-normal">Musclor</h4>
                                </div>
                                <div class="card-body">
                                    <h1 class="card-title pricing-card-title">29€ <small class="text-muted">/ m</small></h1>
                                    <ul class="list-unstyled mt-3 mb-4">
                                        <li>Grâce à la formule musclor</li>
                                        <li>disposez de tout notre matériel</li>
                                        <li>ainsi que de l\'avis et des</li>
                                        <li>conseil de nos experts</li>
                                        <li>au plus bas prix !</li>
                                    </ul>
                                    <a href="?case=FO_Abonnement&action=subscription&type=M" class="btn btn-lg btn-block btn-primary">Écoutez nos conseils</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';


               $str.="</div>";
        if($this->message != null){
            $str=$str.'<div class="error"><h2>'.$this->message.'</h2></div>';
        }
        return $str;
	}
}
?>