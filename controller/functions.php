<?php 

header("Content-Type: text/html;charset=utf-8");
require "conexion.php";
class functions extends sqli {

	public function obtenerProductos(){
		$sql="SELECT * FROM productos WHERE estado = 1 ORDER BY id DESC";
		$result = parent::query_return($sql);
		if(parent::num_rows($result)>0){
			while ($row = parent::fetch_array_all($result)) {
				$productos []=$row;
			}
			return $productos;
		}else{
			return false;
		}
	}

	public function obtenerProducto($id){
		$sql="SELECT * FROM productos WHERE estado = 1 AND id = $id";
		$result = parent::query_return($sql);
		if(parent::num_rows($result)>0){
			while ($row = parent::fetch_array_all($result)) {
				$usuarios []=$row;
			}
			return $usuarios;
		}else{
			return false;
		}
	}

	public function obtenerNumeroVentas(){
		$sql="SELECT COUNT(*) FROM ventas";
		$result = parent::query_return($sql);
		if(parent::num_rows($result)>0){
			while ($row = parent::fetch_array_all($result)) {
				$ventas=$row[0];
			}
			return $ventas;
		}else{
			return false;
		}
	}

	public function obtenerNumeroProductos(){
		$sql="SELECT COUNT(*) FROM productos WHERE estado = 1";
		$result = parent::query_return($sql);
		if(parent::num_rows($result)>0){
			while ($row = parent::fetch_array_all($result)) {
				$productos=$row[0];
			}
			return $productos;
		}else{
			return false;
		}
	}

	public function obtenerNumeroUsuarios(){
		$sql="SELECT COUNT(*) FROM usuario";
		$result = parent::query_return($sql);
		if(parent::num_rows($result)>0){
			while ($row = parent::fetch_array_all($result)) {
				$usuario=$row[0];
			}
			return $usuario;
		}else{
			return false;
		}
	}

	public function obtenerPedidos(){
		$sql="SELECT ventas.id, ventas.total, ventas.fecha, usuario.nombre as nombre FROM ventas INNER JOIN usuario ON ventas.id_usuario = usuario.id";
		$result = parent::query_return($sql);
		if(parent::num_rows($result)>0){
			while ($row = parent::fetch_array_all($result)) {
				$pedidos[] = $row;
			}
			return $pedidos;
		}else{
			return false;
		}
	}


	public function LogeoUser($email,$password){
		$contador=0;
		$sql="SELECT * FROM usuario";					
		$result = parent::query_return($sql);
		if(parent::num_rows($result)>0){	
			while ($row = parent::fetch_array_all($result)) {
				if(($row['email']==$email) and ($row['password']==$password)){
					$contador=1;
					return $row;	
					exit;
				}				
			}
			if($contador==0){
				return false;
			}	
		}else{	
			return false;					
		}

	}

	public function buscarUsuarioEmail($email){
		$sql = "SELECT * FROM usuario WHERE email = '$email'";
		$result = parent::query_return($sql);	
		if(parent::num_rows($result)>0){
			return true;
		}else{	
			return false;					
		}
	}

	public function insert_datos($insert){	
		if(parent::query($insert)){
			return true;
		}else{
			return false;
		}
	}

	public function insert_id(){	
		return parent::insert_id();
	}

}

?>