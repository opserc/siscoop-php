<?php 
require_once "../modelos/Contrato.php";

$contrato=new Contrato();

$idcontrato=isset($_POST["idcontrato"])? limpiarCadena($_POST["idcontrato"]):"";
$idsocio=isset($_POST["idsocio"])? limpiarCadena($_POST["idsocio"]):"";
$ncontrato=isset($_POST["ncontrato"])? limpiarCadena($_POST["ncontrato"]):"";
$condicion=isset($_POST["condicion"])? limpiarCadena($_POST["condicion"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		
		if (empty($idcontrato)){
			$rspta=$contrato->insertar($idsocio,$ncontrato,$condicion);
			echo $rspta ? "Contrato registrado" : "Contrato no se pudo registrar";
		}
		else {
			$rspta=$contrato->editar($idcontrato,$idsocio,$ncontrato,$condicion);
			echo $rspta ? "Contrato modificado" : "Contrato no se pudo modificar";
		}
	break;

	case 'mostrar':
		$rspta=$contrato->mostrar($idcontrato);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$contrato->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				 "0"=>('<button class="btn btn-warning" onclick="mostrar('.$reg->idcontrato.')"><i class="fa fa-pencil"></i></button>').
				 '<a target="_blank" href="../reportes/exContrato.php?id='.$reg->idcontrato.'"><button class="btn btn-info"><i class="fa fa-file"></i></button></a>',
 				"1"=>$reg->ncontrato,
 				"2"=>$reg->socio,
 				"3"=>$reg->fecha,
 				"4"=>($reg->condicion=='Activado')?'<span class="label bg-green">Activo</span>':
 				'<span class="label bg-green">'.$reg->condicion.'</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case "selectSocio":
		require_once "../modelos/Socio.php";
		$socio = new Socio();

		$rspta = $socio->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idsocio . '>' . $reg->nombre . '</option>';
				}
	break;
}
?>