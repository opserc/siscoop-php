<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Socio
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nsocio,$tipo_persona,$nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$fecha_nac)
	{
		$sql="INSERT INTO socio (nsocio,tipo_persona,nombre,tipo_documento,num_documento,direccion,telefono,email,fecha_nac)
		VALUES ('$nsocio','$tipo_persona','$nombre','$tipo_documento','$num_documento','$direccion','$telefono','$email','$fecha_nac')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idsocio,$nsocio,$tipo_persona,$nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$fecha_nac)
	{
		$sql="UPDATE socio SET nsocio='$nsocio',tipo_persona='$tipo_persona',nombre='$nombre',tipo_documento='$tipo_documento',num_documento='$num_documento',direccion='$direccion',telefono='$telefono',email='$email',fecha_nac='$fecha_nac' WHERE idsocio='$idsocio'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idsocio)
	{
		$sql="DELETE FROM socio WHERE idsocio='$idsocio'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idsocio)
	{
		$sql="SELECT * FROM socio WHERE idsocio='$idsocio'";
		return ejecutarConsultaSimpleFila($sql);
	}

	
	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM socio";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM socio where condicion='Activo'";
		return ejecutarConsulta($sql);		
	}

	/*
	//Implementar un método para listar los registros 
	public function listarc()
	{
		$sql="SELECT * FROM socio WHERE tipo_persona='Cliente'";
		return ejecutarConsulta($sql);		
	}
	*/
}

?>