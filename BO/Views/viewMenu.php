<?php 

class viewMenu implements viewsComponent_interface {
    public function __construct() {  
    }
	
	public function insideHtml() {
        ob_start();//capture tous les flux http vers un tampon en mémoire
?>      <nav class="navbar navbar-expand-md navbar-dark bg-primary sticky-top" id="navBar">
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
                    </li>
                    
                    <?php if(!Session::isLogged()){ ?>
							<li class="nav-item dropdown">
							<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" id="navbarDropdownMenuLink" data-close-others="false">
								NewsLetter
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
								<a class="dropdown-item active" href="index.php?case=BO_Newsletter&action=subscribe">Inscription</a>
								<a class="dropdown-item active" href="index.php?case=BO_Newsletter&action=unsubscribe">Désinscription</a>
							</div>
						</li>
					<?php } 

						if(Session::getUserType()[0]!=1){?>
							<li class="nav-item">
								<a class="nav-link" href="index.php?case=BO_Users&action=view">Utilisateurs</a>
							</li>
						<?php } ?>
						<li class="nav-item">
							<a class="nav-link" href="index.php?case=BO_Newsletter&action=view">Newsletter</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="index.php?case=BO_Commentaires&action=view">Commentaires</a>
                        </li>
						<li class="nav-item">
							<a class="nav-link" href="index.php?case=BO_Abonnements&action=view">Abonnements</a>
						</li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?case=BO_Articles&action=view&view=1">Articles</a>
                    </li>
                </ul>
            </div>
            <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                <ul class="navbar-nav ml-auto">
                <?php 
                    switch (Session::isLogged()) {
                        case true:
                            ?>

                            <li class="nav-item">
                                <a class="nav-link" href="../FO/index.php?case=FO_Account&action=view">Mon compte</a>
                            </li>

                            <?php
                            break;
                        default:
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?case=BO_Registration&action=register" id="userAdd">Inscription</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?case=BO_Registration&action=connexion" id="userConnect">Connexion</a>
                            </li>
                        <?php
                            break;
                    }
                ?>
                    
                </ul>
            </div>
            <!--<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Déconnexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pannel Administrateur</a>
                    </li>
                </ul>
            </div>-->
            </nav>
<?php
        $str = ob_get_contents(); //rédirige le contenu du tampon vers une variable
        ob_end_clean(); //arrête la capture des flux vers un tampon
        return $str;
	}
}
?>