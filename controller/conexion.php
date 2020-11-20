<?php
class sqli{

	public $conexion;

	public function __construct(){
		
		$_host = "localhost";
		$_user = "root";
		$_pass = "";
		$_db   = "carrito";
		$this->conexion = new mysqli($_host, $_user, $_pass, $_db);	
		$acentos = $this->conexion->query("SET NAMES 'utf8'");
		if (mysqli_connect_errno()) exit("Falló la conexión: ". $this->conexion->connect_error);
	}

	public function __destruct(){

	}

	public function query_return($slq){

		$result = $this->conexion->query($slq);

		if(!$result)
			exit("Error en la consulta: ".$this->error());

		else
			return $result;

	}

	public function query($sql){

		if($this->conexion->query($sql))
			return true;

	}

	public function fetch_array_all($result){

		return $result->fetch_array(MYSQLI_BOTH);

	}

	
	public function num_rows($result){

		return $result->num_rows;

	}

	public function insert_id(){

		return $this->conexion->insert_id;
	}

	public function close(){

		$this->conexion->close();

	}	

	public function error(){

		return $this->conexion->error;

	}

	

}

?>