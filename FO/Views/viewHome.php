<?php 

class viewHome implements viewsComponent_interface {
	private $message = null;
    public function __construct() {  
    }
	public function setMessage($message){
		$this->message=$message;
	}
	public function getGymComments($comments){
		$this->comments=$comments;
	}
	public function getUser($users){
		$this->users=$users;
	}
	public function insideHtml()
	{
		$str = '<!-- <div id="workout-carousel" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active img-fluid" data-interval="10000">
							<img align="bottom" src="./Tools/imgs/workout-1.jpeg" class="caroussel-img d-block w-100" alt="...">
						</div>
						<div class="carousel-item img-fluid" data-interval="2000">
							<img align="bottom" src="./Tools/imgs/workout-2.jpg" class="caroussel-img d-block w-100" alt="...">
						</div>
						<div class="carousel-item img-fluid">
							<img align="bottom" src="./Tools/imgs/workout-3.jpeg" class="caroussel-img d-block w-100" alt="...">
						</div>
					</div>
					<a class="carousel-control-prev" href="#workout-carousel" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#workout-carousel" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div> -->


				<div class="container marketing">
					<div class="row">
						<div class="col-lg-4">
							<div class="marketing-round">
								<img src="./Tools/imgs/accounting-coins-stack.png" alt"accounting coins stack">
							</div>
							<h2>Moins chère</h2>
							<p>Notre salle de sport se démarque grâce à son prix très faible et ses nombreux avantages.</p>
						</div>
						<div class="col-lg-4">
							<div class="marketing-round">
								<img src="./Tools/imgs/fitness-weighlifting-bench.png" alt"fitness weighlifting bench">
							</div>
							<h2>Matériel performant</h2>
							<p>Notre salle de sport vous garanti un matériel de top qualitée et avec beaucoup de variété pour que vous puissiez pratiquer avec le plus grand plaisir.</p>
						</div>
						<div class="col-lg-4">
							<div class="marketing-round">
								<img src="./Tools/imgs/notes-paper-text.png" alt"notes paper text">
							</div>
							<h2>Articles</h2>
							<p>Nous vous proposons tout une gamme d\'articles gratuits concernant le sport, les différentes méthodes d\'entrainement et la nutrition.</p>
						</div>
					</div>
				</div>
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
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="comment">
					<div class="container">';
					if(Session::isLogged()){	
						$str.='<form method="post">
							<div class="btns">
								<button type="submit" name="sendComment" class="btn btn-primary">Envoyer un message</button>
							</div>
							<div>
								<textarea rows="10" cols="100" name="commentContent">
								</textarea>
							</div>
						</form>
						';
					}
					for($i=0;$i<count($this->comments);$i++){
						$date=$this->comments[$i]['dateCommentaireSalle'];
						$content=$this->comments[$i]['texteCommentaireSalle'];

						for($j=0;$j<count($this->users);$j++){
							if($this->comments[$i]['idUtilisateur']===$this->users[$j]['idUtilisateur']){
								$sender =$this->users[$j]['pseudo'];
							}
						}
						$str.='
						<div class="comments">
							<h2>'.$sender.'</h2>
							<span>'.$date.'</span>
							<p>'.$content.'</p>
						</div>';
					}
					$str.='</div>
				</div>';
				if($this->message != null){
					$str=$str.'<div class="error"><h2>'.$this->message.'</h2></div>';
				}
				$str.='
				<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
        		<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
				';
        return $str;
	}
}
?>