<?php include("../autoload.php");?>		
<?php //include("security.php");?>						
<?php




$action = "";
if(isset($_REQUEST["action"]) and $_REQUEST["action"]!=""){
	$action = $_REQUEST["action"];
}

$values = $_REQUEST;
	switch ($action) {
		case "index":
			executeIndex($values);	
		break;
		case "bienvenida":
			executeBienvenida($values);	
		break;
		case "acceso":
			executeBienvenida($values);	
		break;
		case "logout":
			executeLogout($values);	
		break;
		default:
			executeIndex($values);
		break;
	}
						
	function executeIndex($values = null){
	session_unset();
	require('login.php');
	}
	function executeBienvenida($values = null){
		
		$securimage = new Securimage();
		$captcha = $values['ct_captcha'];
		if ($securimage->check($captcha) == false) {
		  $errors['captcha_error'] = 'Incorrect security code entered<br />';
				$values['error'] = "Imagen incorrecta";
				require('login.php');die;
		}
		if((!isset($values['password']) or $values['password'] == '')  or (!isset($values['password']) or $values['password'] == '') )
		{
			$values['error'] = "Debe indicar el usuario y la clave";
			require('login.php');die;
		}else
		{
			$Users = new Users();
			$user_data = $Users->getUserByPassword($values);
			if($user_data['id_user']=="")
			{
				$values['error'] = "Usuario o clave incorrecto";
				require('login.php');die;
			}
			else
			{	$ConnectionsHistory = new ConnectionsHistory();
                                $Utilitarios = new Utilitarios();
				$id_user =  $user_data['id_user'];
				$values['id_user'] = $id_user;
				$user_data = $Users->getUserById($values);
				$_SESSION['login'] = $user_data['login'];
				$_SESSION['id_user'] = $user_data['id_user'];
                                $_SESSION['rol'] = $user_data['rol'];
                                //print_r($values);die;
                                unset($values['password'],$values['ct_captcha']);
                                $values['ip'] = $Utilitarios ->getRealIP();
                                $ConnectionsHistory->saveConnectionsHistory($values);
				require('bienvenida.php');die;
			}
			
		}
		
		

	}
	function executeLogout($values = null){
			session_unset();
            executeIndex($values);
	}							