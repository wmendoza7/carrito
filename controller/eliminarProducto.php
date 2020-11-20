<?php 
	include "functions.php";
	$functions = new functions();
	if(isset($_POST["id"])){
		extract($_POST);
		$res = $functions->obtenerProducto($id);
		if (file_exists("../images/".$res[0]["imagen"])) {
			unlink("../images/".$res[0]["imagen"]);
		}

		$delete = "UPDATE productos SET estado = 0 WHERE id = $id";
		$result = $functions->insert_datos($delete);
		
		echo "listo";
	}
	
?>