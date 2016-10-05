<?php
if(!isset($_SESSION['id_user'])){
	
	header("Location: ../errors_pages/login_required.php");	
} 

