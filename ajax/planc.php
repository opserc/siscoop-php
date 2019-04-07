<?php 
require_once "../modelos/Planc.php";

$planc=new Planc();

$idplanc=isset($_POST["idplanc"])? limpiarCadena($_POST["idplanc"]):"";
$codigo=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		
		if (empty($idplanc)){
			$rspta=$planc->insertar($codigo,$nombre,$descripcion);
			echo $rspta ? "Plan de Cuenta registrado" : "Plan de Cuenta no se pudo registrar";
		}
		else {
			$rspta=$planc->editar($idplanc,$codigo,$nombre,$descripcion);
			echo $rspta ? "Plan de Cuenta modificado" : "Plan de Cuenta no se pudo modificar";
		}
	break;

	case 'desactivar':
		$rspta=$planc->desactivar($idplanc);
 		echo $rspta ? "Plan de Cuenta Desactivado" : "Plan de Cuenta no se puede desactivar";
	break;

	case 'activar':
		$rspta=$planc->activar($idplanc);
 		echo $rspta ? "Plan de Cuenta activado" : "Plan de Cuenta no se puede activar";
	break;

	case 'mostrar':
		$rspta=$planc->mostrar($idplanc);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$planc->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idplanc.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idplanc.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idplanc.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idplanc.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->codigo,
 				"3"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;	
}
?>