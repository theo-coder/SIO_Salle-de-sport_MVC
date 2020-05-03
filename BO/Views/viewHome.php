<?php 

class viewHome implements viewsComponent_interface {
	 
    public function __construct() {  
    }
	
	public function insideHtml()
	{
		$str = '<div id="BO_back">
					<h1 id="BO_title">Administration</h1>
				</div>';
        return $str;
	}
}
?>