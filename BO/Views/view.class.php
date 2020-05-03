<?php
class View {
	public $menu = null;
	public $body = null;
	public $footer = null;
	
	private static $_instance = null;

	public function __construct() {
	}

	public function html() {
		$html = 
		'<!DOCTYPE html>
			<html lang="fr">
			<head>
				<meta charset="utf-8">
				<title>Club de musculation à Besançon - Entre-Haltères</title>
				<meta name="description" content="Club de musculation à Besançon - Entre-Haltères" />
				<link rel="icon" type="image/x-icon" href="https://img.icons8.com/clouds/100/000000/dumbbell.png" />
				<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
				<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
				<link rel="stylesheet" href="./Tools/style.css">
				<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap" rel="stylesheet">
				<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.css" rel="stylesheet">
            
			</head>
			<body>';
			if(isset($this->menu)) {
					$html = $html .$this->menu->insideHtml();
			}
			if(isset ($this->body)) {
					$html = $html ."<div class='col-centered'><center>";
					$html = $html .$this->body->insideHtml();
					$html = $html ."</center></div>";
			}
			if(isset ($this->footer)) {
					$html = $html .$this->footer->insideHtml();
			}

			$html=$html.
			'	
				<script src="./Tools/script.js"></script>
				<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
				<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
				<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
				<!--<script src="./Tools/bootstrap-hover-dropdown.min.js"></script>-->
				<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.js"></script>";
				<script>
					$(document).ready(function() {
					$("#summernote").summernote();
					  });
				</script>
			</body>
			</html>';
			return $html;
	}
}
?>