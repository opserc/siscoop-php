<?php 
require_once "../modelos/Socio.php";

$socio=new Socio();

$idsocio=isset($_POST["idsocio"])? limpiarCadena($_POST["idsocio"]):"";
$nsocio=isset($_POST["nsocio"])? limpiarCadena($_POST["nsocio"]):"";
$tipo_persona=isset($_POST["tipo_persona"])? limpiarCadena($_POST["tipo_persona"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$tipo_documento=isset($_POST["tipo_documento"])? limpiarCadena($_POST["tipo_documento"]):"";
$num_documento=isset($_POST["num_documento"])? limpiarCadena($_POST["num_documento"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$fecha_nac=isset($_POST["fecha_nac"])? limpiarCadena($_POST["fecha_nac"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idsocio)){
			$rspta=$socio->insertar($nsocio,$tipo_persona,$nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$fecha_nac);
			echo $rspta ? "Socio registrado" : "Socio no se pudo registrar";
		}
		else {
			$rspta=$socio->editar($idsocio,$nsocio,$tipo_persona,$nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$fecha_nac);
			echo $rspta ? "Socio actualizado" : "Socio no se pudo actualizar";
		}
	break;

	case 'eliminar':
		$rspta=$socio->eliminar($idsocio);
 		echo $rspta ? "Socio eliminado" : "Socio no se puede eliminar";
	break;

	case 'mostrar':
		$rspta=$socio->mostrar($idsocio);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$socio->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idsocio.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="eliminar('.$reg->idsocio.')"><i class="fa fa-trash"></i></button>',
				"1"=>$reg->nsocio, 
				"2"=>$reg->nombre,
 				"3"=>$reg->tipo_documento,
 				"4"=>$reg->num_documento,
 				"5"=>$reg->telefono,
				"6"=>$reg->fecha_ins
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
	/*
	case 'listarc':
		$rspta=$socio->listarc();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idsocio.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="eliminar('.$reg->idsocio.')"><i class="fa fa-trash"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->tipo_documento,
 				"3"=>$reg->num_documento,
 				"4"=>$reg->telefono,
 				"5"=>$reg->email
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
	*/

}
?>