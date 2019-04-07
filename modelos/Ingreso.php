<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";
 
Class Ingreso
{
    //Implementamos nuestro constructor
    public function __construct()
    {
 
    }
 
    //Implementamos un método para insertar registros
    public function insertar($idsocio,$idusuario,$idcontrato,$num_comprobante,$fecha_hora,$total_ingreso,$idplanc,$semana,$cantidad_ingreso)
    {
        //PARA IMPRIMIR ESA VARIABLE EN PHP => print_r($idplanc);
        $sql="INSERT INTO ingreso (idsocio,idusuario,idcontrato,num_comprobante,fecha_hora,total_ingreso,estado)
        VALUES ('$idsocio','$idusuario','$idcontrato','$num_comprobante','$fecha_hora','$total_ingreso','Aceptado')";
        //return ejecutarConsulta($sql);
        $idingresonew=ejecutarConsulta_retornarID($sql);

        
            $num_elementos=0;
            $sw=true;
 
            while ($num_elementos < count($idplanc))
            {
                $sql_detalle = "INSERT INTO detalle_ingreso(idingreso,idplanc,idcategoria,semana,cantidad_ingreso) VALUES ('$idingresonew', '$idplanc[$num_elementos]',2,'$semana[$num_elementos]','$cantidad_ingreso[$num_elementos]')";
                ejecutarConsulta($sql_detalle) or $sw = false;
                $num_elementos=$num_elementos + 1;
            }            
                $sql_detalle = "INSERT INTO detalle_egreso(idingreso,idplanc,idcategoria,semana,cantidad_egreso) VALUES ('$idingresonew', 1,2,0,'$total_ingreso')";
                ejecutarConsulta($sql_detalle) or $sw = false;
           
            return $sw;
           
        
        
    }
 
     
    //Implementamos un método para anular categorías
    public function anular($idingreso)
    {
        $sql="UPDATE ingreso SET estado='Anulado' WHERE idingreso='$idingreso'";
        return ejecutarConsulta($sql);
    }
 
 
    //Implementar un método para mostrar los datos de un registro a modificar
    public function mostrar($idingreso)
    {
        $sql="SELECT i.idingreso,DATE(i.fecha_hora) as fecha,i.idsocio,s.nombre as socio,u.idusuario,u.nombre as usuario,i.idcontrato,c.ncontrato,i.num_comprobante,i.total_ingreso,i.estado FROM ingreso i INNER JOIN socio s ON i.idsocio=s.idsocio INNER JOIN contrato c ON i.idcontrato=c.idcontrato INNER JOIN usuario u ON i.idusuario=u.idusuario WHERE i.idingreso='$idingreso'";
        return ejecutarConsultaSimpleFila($sql);
    }
 
    public function listarDetalle($idingreso)
    {
        $sql="SELECT di.idingreso,di.idplanc,p.nombre,di.semana,di.cantidad_ingreso FROM detalle_ingreso di inner join planc p on di.idplanc=p.idplanc where di.idingreso='$idingreso'";
        return ejecutarConsulta($sql);
    }
 
    //Implementar un método para listar los registros
    public function listar()
    {
        $sql="SELECT i.idingreso,DATE(i.fecha_hora) as fecha,i.idsocio,s.nombre as socio,u.idusuario,u.nombre as usuario,i.idcontrato,c.ncontrato,i.num_comprobante,i.total_ingreso,i.estado FROM ingreso i INNER JOIN socio s ON i.idsocio=s.idsocio INNER JOIN usuario u ON i.idusuario=u.idusuario INNER JOIN contrato c ON i.idcontrato=c.idcontrato ORDER BY i.idingreso desc";
        return ejecutarConsulta($sql);      
    }

    //Implementar un método para listar las Semanas Canceladas
	public function listarSemanas($ncontrato)
	{
		$sql="SELECT i.idcontrato,c.ncontrato,di.idplanc,p.nombre,SUM(di.semana) AS semanas, i.estado FROM ingreso i inner join detalle_ingreso di on i.idingreso=di.idingreso inner join planc p on di.idplanc=p.idplanc inner join contrato c on i.idcontrato=c.idcontrato where i.estado = 'Aceptado' AND c.ncontrato = '$ncontrato' AND di.idplanc = 4 ";
		return ejecutarConsulta($sql);		
	}

    
     
}
 
?>