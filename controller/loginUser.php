<?php 
	include "functions.php";
	$function = new functions();
	session_start();
	
	if(isset($_POST)){
		extract($_POST);
		$password = md5($password);
  		$res = $function->LogeoUser($email,$password);
  		if($res){
  			$_SESSION['datos_login'] = array(
  				"id" => $res['id'],
  				"nombre" => $res['nombre'],	
				"email" => $res['email'],
				"nivel" => $res['nivel']
			);
			echo "ok";
  		}else{
  			echo "error";
  		}
	}
?>