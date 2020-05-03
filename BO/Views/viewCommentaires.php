<?php 

class viewCommentaires implements viewsComponent_interface {
    private $message=null;
    public function __construct() {  
    }
    public function getGymComments($comments){
		$this->comments=$comments;
	}
	public function getUser($users){
		$this->users=$users;
	}
	public function setMessage($message){
		$this->message = $message;
    }
	public function insideHtml(){
        $str='<div class="back"></div>
        <div class="accountContain">
            <h2 class="accountTitle">Commentaires</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Pseudo</th>
                        <th scope="col">Date</th>
                        <th scope="col">Commentaire</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>';

                    for($i=0;$i<count($this->comments);$i++){
                        $date=$this->comments[$i]['dateCommentaireSalle'];
                        $content=$this->comments[$i]['texteCommentaireSalle'];

                        for($j=0;$j<count($this->users);$j++){
                            if($this->comments[$i]['idUtilisateur']===$this->users[$j]['idUtilisateur']){
                                $sender =$this->users[$j]['pseudo'];
                            }
                        }
                        $str.='
                        <form method="post">
                        <tr>
                                    <th scope="row">'.$this->comments[$i]['idCommentaire'].'</th>
                                    <td>'.$sender.'</td>
                                    <td>'.$date.'</td>
                                    <td>'.$content.'</td>
                                    <input type="hidden" name="idCommentaire" value="'.$this->comments[$i]['idCommentaire'].'">
                                    <td><button class="btn btn-danger" type="submit" name="deleteCom">Supprimer</button></td>
                                </tr>
                                </form>';
                    }
                    $str.='
                </tbody>
            </table>
        </div>';
        if($this->message != null){
            $str=$str.'<div class="error"><h2>'.$this->message.'</h2></div>';
        }
        return $str;
	}
}
?>