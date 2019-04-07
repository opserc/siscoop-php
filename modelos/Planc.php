<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Planc
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($codigo,$nombre,$descripcion)
	{
		$sql="INSERT INTO planc (codigo,nombre,descripcion,condicion)
		VALUES ('$codigo','$nombre','$descripcion','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idplanc,$codigo,$nombre,$descripcion)
	{
		$sql="UPDATE planc SET codigo='$codigo',nombre='$nombre',descripcion='$descripcion' WHERE idplanc='$idplanc'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($idplanc)
	{
		$sql="UPDATE planc SET condicion='0' WHERE idplanc='$idplanc'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($idplanc)
	{
		$sql="UPDATE planc SET condicion='1' WHERE idplanc='$idplanc'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idplanc)
	{
		$sql="SELECT * FROM planc WHERE idplanc='$idplanc'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT idplanc,codigo,nombre,descripcion,condicion FROM planc";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros activos
	public function listarActivos()
	{
		$sql="SELECT idplanc,codigo,nombre,descripcion,condicion FROM planc WHERE condicion='1'";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros activos, su último precio y el stock (vamos a unir con el último registro de la tabla detalle_ingreso)
	/*
		public function listarActivosVenta()
		{
			$sql="SELECT a.idpc,a.idcategoria,c.nombre as categoria,a.codigo,a.nombre,a.stock,(SELECT precio_venta FROM detalle_ingreso WHERE idpc=a.idpc order by iddetalle_ingreso desc limit 0,1) as precio_venta,a.descripcion,a.imagen,a.condicion FROM planc a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
			return ejecutarConsulta($sql);		
		}
	*/
}

?>