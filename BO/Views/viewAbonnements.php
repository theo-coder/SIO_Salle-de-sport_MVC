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
        print_r($this->abonnements);
        $str="<div class='back'></div>
        <div class='accountContain'>

        </div>";
        if($this->message != null){
            $str=$str.'<div class="error"><h2>'.$this->message.'</h2></div>';
        }
        return $str;
	}
}
?>