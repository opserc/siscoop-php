<?php 
require_once "../modelos/Afiliado.php";

$afiliado=new Afiliado();

$idafiliado=isset($_POST["idafiliado"])? limpiarCadena($_POST["idafiliado"]):"";
$idcontrato=isset($_POST["idcontrato"])? limpiarCadena($_POST["idcontrato"]):"";
$tipo_persona=isset($_POST["tipo_persona"])? limpiarCadena($_POST["tipo_persona"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$tipo_documento=isset($_POST["tipo_documento"])? limpiarCadena($_POST["tipo_documento"]):"";
$num_documento=isset($_POST["num_documento"])? limpiarCadena($_POST["num_documento"]):"";
$condicion=isset($_POST["condicion"])? limpiarCadena($_POST["condicion"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		
		if (empty($idafiliado)){
			$rspta=$afiliado->insertar($idcontrato,$tipo_persona,$nombre,$tipo_documento,$num_documento,$condicion);
			echo $rspta ? "Afiliado registrado" : "Afiliado no se pudo registrar";
		}
		else {
			$rspta=$afiliado->editar($idafiliado,$idcontrato,$tipo_persona,$nombre,$tipo_documento,$num_documento,$condicion);
			echo $rspta ? "Afiliado modificado" : "Afiliado no se pudo modificar";
		}
	break;

	case 'mostrar':
		$rspta=$afiliado->mostrar($idafiliado);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$afiliado->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idafiliado.')"><i class="fa fa-pencil"></i></button>',
 				"1"=>$reg->ncontrato,
                "2"=>$reg->nombre,
                "3"=>$reg->num_documento,                 
 				"4"=>$reg->fecha,
 				"5"=>($reg->condicion=='Activado')?'<span class="label bg-green">Activo</span>':
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

	case "selectContrato":
		require_once "../modelos/Contrato.php";
		$contrato = new Contrato();

		$rspta = $contrato->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idcontrato . '>' . $reg->ncontrato . '</option>';
				}
	break;
}
?>