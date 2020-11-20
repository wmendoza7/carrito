<?php 
	include "functions.php";
	$function = new functions();

	if(isset($_POST)){
		extract($_POST);
		$password = md5($password);
		$existe = $function->buscarUsuarioEmail($email);
		if(!$existe){
			$query = "INSERT INTO usuario(nombre, telefono, email, password, nivel) VALUES ('$nombre','$telefono','$email','$password','$nivel')";
  			$res = $function->insert_datos($query);
  			if($res){
  				echo 'ok';
	  		}else{
	  			echo "error";
	  		}
		}else{
			echo "existe";
		}  		
	}
?>