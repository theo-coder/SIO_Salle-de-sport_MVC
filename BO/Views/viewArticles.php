<?php 

class viewArticles implements viewsComponent_interface {
    private $message = null;
    public function __construct() {  
    }
	public function setMessage($message){
		$this->message = $message;
    }
	public function getCategories($categories){
        $this->categorie = $categories;
    }
	public function getArticles($articles){
        $this->articles = $articles;
    }
	public function insideHtml(){
        $str='<div class="back"></div>
            <div class="accountContain">
                <ul class="nav justify-content-center navCateg">';

                    for($i=0;$i<count($this->categorie);$i++){
                        $str.='<li class="nav-item navCategItem">
                                    <a href="?case=BO_Articles&action=view&view='.$this->categorie[$i]["idCategorie"].'" class="btn btn-primary">'.$this->categorie[$i]['titre'].'</a>
                                </li>';
                    }
                $str.='
                    <li class="nav-item navCategItem">
                        <a class="btn btn-info" href="?case=BO_Articles&action=view&view=addCateg" name="addCateg">+</a>
                    </li>
                </ul>';

                if(isset($_GET["view"])&&$_GET["view"]=="addCateg"){
                    $str.='
                            <form method="post">
                                <input class="form-control categNameInput" type="text" name="categName" placeholder="Nom de la catégorie">
                                </input>
                                <button type="submit" class="btn btn-primary btnCateg" name="categSubmit">Valider</button>
                            </form>
                        </div>
                    ';
                } else {
                    $str .= '<div class="row mx-4">';
                    foreach($this->articles as $article){
                        if($article['imageArticle'] == "")
                            $article['imageArticle'] = "placeholder.png";
                        $str.='
                        <div class="col-lg-6">
                        <div class="card mb-4" style="width: 100%;">
                            <img src="./Tools/articles/'.$article['imageArticle'].'" style="max-height: 180px; object-fit: cover;" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">'.$article['titre'].'</h5>
                                <p class="card-text">'.$article['texteHtml'].'</p>
                                <a href="#" class="btn btn-primary">Modifier</a>
                                <a href="#" class="btn btn-danger">Supprimer</a>
                            </div>
                        </div>
                        </div>
                        ';
                    }

                    
                $str.='</div><br/>
                <a class="btn btn-link" href="?case=BO_Articles&action=add" name="addCateg">Nouvel article</a>
                </div>';
        }
        if($this->message != null){
            $str=$str.'<div class="error"><h2>'.$this->message.'</h2></div>';
        }
        return $str;
	}
}
?>