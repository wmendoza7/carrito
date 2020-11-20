<?php 
	session_start();
	if (isset($_SESSION["carrito"])) {
		var_dump($_SESSION["carrito"]);
		$arreglo = $_SESSION["carrito"];
	}
	if(count($arreglo) > 1){
		for ($i=0; $i < count($arreglo); $i++) { 
			if($arreglo[$i]['Id'] != $_POST['id']){
				$arregloNuevo[] = array(
					'Id' => $arreglo[$i]["Id"],
		          	'Nombre' => $arreglo[$i]["Nombre"],
		          	'Precio' => $arreglo[$i]["Precio"],
		          	'Imagen' => $arreglo[$i]["Imagen"],
		          	'Inventario' => $arreglo[$i]["Inventario"],
		          	'Cantidad' => $arreglo[$i]["Cantidad"]
				);
			}			
		}
		$_SESSION["carrito"] = $arregloNuevo;
	}else{
		unset($_SESSION["carrito"]);
	}
	echo "ok";
?>