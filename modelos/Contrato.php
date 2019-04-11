<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Contrato
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar contratos
	public function insertar($idsocio,$ncontrato,$condicion)
	{
		$sql="INSERT INTO contrato (idsocio,ncontrato,fecha,condicion)
		VALUES ('$idsocio','$ncontrato',CURRENT_TIMESTAMP,'$condicion')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar contratos
	public function editar($idcontrato,$idsocio,$ncontrato,$condicion)
	{
		$sql="UPDATE contrato SET idsocio='$idsocio',ncontrato='$ncontrato',condicion='$condicion' WHERE idcontrato='$idcontrato'";
		return ejecutarConsulta($sql);
	}

		//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idcontrato)
	{
		$sql="SELECT * FROM contrato WHERE idcontrato='$idcontrato'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los contratos
	public function listar()
	{
		$sql="SELECT c.idcontrato,c.idsocio,s.nombre as socio,c.ncontrato,c.fecha,c.condicion FROM contrato c INNER JOIN socio s ON c.idsocio=s.idsocio";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros y mostrar en el select
	public function listarContratos($idsocio)
	{
		$sql="SELECT c.idcontrato,c.ncontrato,c.condicion FROM contrato c INNER JOIN socio s ON c.idsocio=s.idsocio WHERE c.idsocio = '$idsocio' AND c.condicion = 'Activo' ";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM contrato where condicion='Activo'";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los contratos activos
	public function listarActivos()
	{
		$sql="SELECT c.idcontrato,c.idsocio,s.nombre as socio,c.ncontrato,c.fecha,c.condicion FROM contrato c INNER JOIN socio s ON c.idsocio=s.idsocio WHERE c.condicion='Activo'";
		return ejecutarConsulta($sql);		
	}

	public function contratocabecera($idcontrato){
		$sql="SELECT c.idcontrato,c.idsocio,c.ncontrato,c.fecha,s.nsocio,s.nombre,s.tipo_documento,s.num_documento,s.direccion,s.telefono FROM contrato c INNER JOIN socio s ON c.idsocio=s.idsocio WHERE c.idcontrato='$idcontrato'";
		return ejecutarConsulta($sql);
	}

	public function contratodetalle($idcontrato){
		$sql="SELECT idcontrato,nombre,num_documento,DATE(fecha) AS fecha FROM afiliado WHERE idcontrato='$idcontrato'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los contratos activos, su último precio y el stock (vamos a unir con el último registro de la tabla detalle_ingreso)
	/*
		public function listarActivosVenta()
		{
			$sql="SELECT a.idpc,a.idsocio,c.condicion as categoria,a.ncontrato,a.condicion,a.stock,(SELECT precio_venta FROM detalle_ingreso WHERE idpc=a.idpc order by iddetalle_ingreso desc limit 0,1) as precio_venta,a.descripcion,a.imagen,a.condicion FROM contrato a INNER JOIN categoria c ON a.idsocio=c.idsocio WHERE a.condicion='1'";
			return ejecutarConsulta($sql);		
		}
	*/
}

?>