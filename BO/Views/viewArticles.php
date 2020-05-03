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
	public function insideHtml(){
        $str='<div class="back"></div>
            <div class="accountContain">
                <ul class="nav justify-content-center navCateg">';

                    for($i=0;$i<count($this->categorie);$i++){
                        $str.='<li class="nav-item navCategItem">
                                    <button type="submit" name="" class="btn btn-primary" href="#">'.$this->categorie[$i]['titre'].'</button>
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
                $str.='<table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        </tr>
                        <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        </tr>
                        <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
            </div>';
        }
        if($this->message != null){
            $str=$str.'<div class="error"><h2>'.$this->message.'</h2></div>';
        }
        return $str;
	}
}
?>