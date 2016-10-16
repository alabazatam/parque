<?php
if(!isset($_SESSION['id_user']) or $_SESSION['rol'] !='ADM'){
	
	header("Location: ../errors_pages/login_required.php");	
} 

