<?php 

class viewHomeMenu implements viewsComponent_interface {
	private $message=null;
    public function __construct() {  
    }
	public function getUserPseudo($pseudo){
		$this->pseudo=$pseudo['pseudo'];
	}
	public function getUserEmail($email){
		$this->email=$email['mailUtilisateur'];
	}
	public function getTypeUser($type){
		$this->type=Session::getUserType()['typeUtilisateur'];
	}
	public function getNewsletterInscrit($val){
		if($val=="1"){
			$this->inscrit="On";
			$this->color="#5E9A78";
		}else{
			$this->inscrit="Off";
			$this->color="#FF4444";
		}
	}
	public function setMessage($message){
		$this->message = $message;
	}
	public function insideHtml()
	{
		if($this->message!=null){
			$str='<center><div class="error-changement"><h2>'.$this->message.'</h2></div></center>';
		}
		$str .= '
			<header id="carouselHeader" class="carousel slide carousel-fade" data-ride="carousel">
				<img src="./Tools/imgs/dumbbell.png" id="logoEH" alt="Logo Entre-Haltères" class="img-fluid mx-auto pt-5 d-none d-sm-block"/>
				<span id="carouselHeaderSpan">Entre Haltères<br/>Musculation</span>
				<ol class="carousel-indicators">
					<li data-target="#carouselHeader" data-slide-to="0" class="active"></li>
					<li data-target="#carouselHeader" data-slide-to="1"></li>
					<li data-target="#carouselHeader" data-slide-to="2"></li>
				</ol>
				<div class="carousel-inner">
					<div class="carousel-item active" data-interval="2000">
						<img class="d-block w-100" src="./Tools/imgs/workout-1.jpeg" alt="slide1">
					</div>
					<div class="carousel-item" data-interval="2000">
						<img class="d-block w-100" src="./Tools/imgs/workout-2.jpg" alt="slide2">
					</div>
					<div class="carousel-item" data-interval="2000">
						<img class="d-block w-100" src="./Tools/imgs/workout-3.jpeg" alt="slide3">
					</div>
				</div>
			</header>
			<nav class="navbar navbar-expand-md navbar-dark bg-primary sticky-top navBar-home" id="navBar">
				<div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<img src="./Tools/imgs/dumbbell.png" alt="dumbbell" style="width:50px;" />
						</li>
					</ul>
				</div>
				<div class="mx-auto order-0">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a class="nav-link" href="index.php">Accueil</a>
						</li>';
						if($this->type!=1){
							$str.='<li class="nav-item">
								<a class="nav-link" href="index.php?case=BO_Users&action=view">Utilisateurs</a>
							</li>';
						}
						$str.='
						<li class="nav-item">
							<a class="nav-link" href="index.php?case=BO_Newsletter&action=view">Newsletter</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="index.php?case=BO_Commentaires&action=view">Commentaires</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="index.php?case=BO_Articles&action=view">Articles</a>
						</li>
					</ul>
				</div>
				<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
						<!-- Trigger the modal -->
							<a id="myBtn" class="nav-link" href="#">Profil</a>

							<!-- The Modal -->
							<div id="myModal" class="mymodal">
							<!-- Modal content -->
							
								<div class="mymodal-container">
									<div class="mymodal-body">
										<span class="close">&times;</span>
										<img id="userImg" class="profil-picture" src="';
										if(file_exists('./Tools/uploads/'.Session::getUserID()[0].'.jpg')){
											$str.='./Tools/uploads/'.Session::getUserID()[0].'.jpg';
										} else if(file_exists('./Tools/uploads/'.Session::getUserID()[0].'.png')){
											$str.='./Tools/uploads/'.Session::getUserID()[0].'.png';
										} else if(file_exists('./Tools/uploads/'.Session::getUserID()[0].'.jpeg')){
											$str.='./Tools/uploads/'.Session::getUserID()[0].'.jpeg';
										} else {
											$str.='./Tools/imgs/profil.jpg';
										}
										$str.='">
										<form method="post" enctype="multipart/form-data" id="imgForm">
											<div class="circle-hover">
												<img class="edit-profil" src="./Tools/imgs/edit-profil-picture.png">
												<input class="input-hidden" type="file" id="avatar" name="avatar" accept="image/jpg, image/jpeg, image/png>
											</div>
											<div class="validateText" id="validateText"></div>
											<button type="submit" name="validate" id="validate" class="validate">Valider l\'image ?</button>
										</form>
										<center class="mymodal-body-content">
											<a href="#" id="pseudo">'.$this->pseudo.'</a><br/>
											<form method="post" enctype="multipart/form-data" id="pseudo-input"><input type="text" name="pseudoChanged" placeholder="'.$this->pseudo.'"><button name="pseudoChange" type="submit" id="pseudo-button">Ok</button><br/></form>
											<hr>
											<a href="#" id="email">'.$this->email.'</a>
											<form method="post" enctype="multipart/form-data" id="email-input"><input type="text" name="emailChanged" placeholder="'.$this->email.'"><button name="emailChange" type="submit" id="email-button">Ok</button><br/></form>
											<div id="abonnement-link">
												<a href="#">Mon abonnement</a>
											</div>
											<div id="newsletter">
												<span id="newsletter-label">Inscription à la newsletter</span>
												<form method="post" enctype="multipart/form-data" id="newsletter-input"><button type="submit" name="newsletterChange" id="newsletterButton" style="background:'.$this->color.'">'.$this->inscrit.'</button><br/></form>
											</div>
										</center>
										<center class="mymodal-footer-content">
										<a id="admin-button" href="../FO/index.php">Retour au site</a>
												<a id="deco-button" href="index.php?case=BO_Disconnect">Déconnexion</a>
											<a id="details" href="index.php?case=BO_Account&action=view">Plus de détails</a>
										</center>
									</div>
								</div>

							</div>
							<!---------->

						</li>
					</ul>
				</div>
			</nav>';
        return $str;
	}
}
?>