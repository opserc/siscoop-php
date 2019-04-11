<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Afiliado
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar afiliados
	public function insertar($idcontrato,$tipo_persona,$nombre,$tipo_documento,$num_documento,$condicion)
	{
		$sql="INSERT INTO afiliado (idcontrato,tipo_persona,nombre,tipo_documento,num_documento,fecha,condicion)
		VALUES ('$idcontrato','$tipo_persona','$nombre','$tipo_documento','$num_documento',CURRENT_TIMESTAMP,'$condicion')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar afiliados
	public function editar($idafiliado,$idcontrato,$tipo_persona,$nombre,$tipo_documento,$num_documento,$condicion)
	{
		$sql="UPDATE afiliado SET idcontrato='$idcontrato',tipo_persona='$tipo_persona',nombre='$nombre',tipo_documento='$tipo_documento',num_documento='$num_documento',condicion='$condicion' WHERE idcontrato='$idcontrato'";
		return ejecutarConsulta($sql);
	}

		//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idafiliado)
	{
		$sql="SELECT * FROM afiliado WHERE idafiliado='$idafiliado'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los afiliados
	public function listar()
	{
		$sql="SELECT a.idafiliado,a.idcontrato,c.ncontrato,a.nombre,a.num_documento,a.fecha,a.condicion FROM afiliado a INNER JOIN contrato c ON a.idcontrato=c.idcontrato";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los afiliados activos
	public function listarActivos()
	{
		$sql="SELECT a.idafiliado,a.idcontrato,c.ncontrato,a.nombre,a.num_documento,a.fecha,a.condicion FROM afiliado a INNER JOIN contrato c ON a.idcontrato=c.idcontrato WHERE a.condicion='Activo'";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los afiliados activos, su último precio y el stock (vamos a unir con el último registro de la tabla detalle_ingreso)
	/*
		public function listarActivosVenta()
		{
			$sql="SELECT a.idpc,a.idcontrato,c.condicion as categoria,a.ncontrato,a.condicion,a.stock,(SELECT precio_venta FROM detalle_ingreso WHERE idpc=a.idpc order by iddetalle_ingreso desc limit 0,1) as precio_venta,a.descripcion,a.imagen,a.condicion FROM contrato a INNER JOIN categoria c ON a.idcontrato=c.idcontrato WHERE a.condicion='1'";
			return ejecutarConsulta($sql);		
		}
	*/
}

?>