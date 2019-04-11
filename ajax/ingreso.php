<?php 

if (strlen(session_id()) < 1) 
  session_start();
 
require_once "../modelos/Ingreso.php";
 
$ingreso=new Ingreso();
 
$idingreso=isset($_POST["idingreso"])? limpiarCadena($_POST["idingreso"]):"";
$idsocio=isset($_POST["idsocio"])? limpiarCadena($_POST["idsocio"]):"";
$idusuario=$_SESSION["idusuario"];
$idcontrato=isset($_POST["idcontrato"])? limpiarCadena($_POST["idcontrato"]):"";
$num_comprobante=isset($_POST["num_comprobante"])? limpiarCadena($_POST["num_comprobante"]):"";
$fecha_hora=isset($_POST["fecha_hora"])? limpiarCadena($_POST["fecha_hora"]):"";
$total_ingreso=isset($_POST["total_ingreso"])? limpiarCadena($_POST["total_ingreso"]):"";
 
switch ($_GET["op"]){
    case 'guardaryeditar':
        if (empty($idingreso)){
            
            $rspta=$ingreso->insertar($idsocio,$idusuario,$idcontrato,$num_comprobante,$fecha_hora,$total_ingreso,$_POST["idplanc"],$_POST["semana"],$_POST["cantidad_ingreso"]);
            echo $rspta ? "Ingreso registrado" : 'No se pudieron registrar todos los datos del ingreso';
        }
        else {
        }
    break;
 
    case 'anular':
        $rspta=$ingreso->anular($idingreso);
        echo $rspta ? "Ingreso anulado" : "Ingreso no se puede anular";
    break;
 
    case 'mostrar':
        $rspta=$ingreso->mostrar($idingreso);
        //Codificar el resultado utilizando json
        echo json_encode($rspta);
    break;
 
    case 'listarDetalle':
        //Recibimos el idingreso
        $id=$_GET['id'];
 
        $rspta = $ingreso->listarDetalle($id);
        $total=0;
        echo '<thead style="background-color:#A9D0F5">
                                    <th>Opciones</th>
                                    <th>Plan de Cuenta</th>
                                    <th>Semana</th>
                                    <th>Cantidad de Ingreso</th>
                                    <th>Subtotal</th>
                                </thead>';
 
        while ($reg = $rspta->fetch_object())
                {
                    echo '<tr class="filas"><td></td><td>'.$reg->nombre.'</td><td>'.$reg->semana.'</td><td>'.$reg->cantidad_ingreso.'</td><td>'.$reg->cantidad_ingreso*$reg->semana.'</td></tr>';
                    $total=$total+($reg->cantidad_ingreso*$reg->semana);
                }
        echo '<tfoot>
                                    <th>TOTAL</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><h4 id="total">S/.'.$total.'</h4><input type="hidden" name="total_ingreso" id="total_ingreso"></th> 
                                </tfoot>';
    break;
 
    case 'listar':
        $rspta=$ingreso->listar();
        //Vamos a declarar un array
        $data= Array();
 
        while ($reg=$rspta->fetch_object()){
            $data[]=array(
                "0"=>($reg->estado=='Aceptado')?'<button class="btn btn-warning" onclick="mostrar('.$reg->idingreso.')"><i class="fa fa-eye"></i></button>'.
                    ' <button class="btn btn-danger" onclick="anular('.$reg->idingreso.')"><i class="fa fa-close"></i></button>':
                    '<button class="btn btn-warning" onclick="mostrar('.$reg->idingreso.')"><i class="fa fa-eye"></i></button>',
                "1"=>$reg->fecha,
                "2"=>$reg->socio,
				"3"=>$reg->usuario,
				"4"=>$reg->ncontrato,
                "5"=>$reg->total_ingreso,
                "6"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':
                '<span class="label bg-red">Anulado</span>'
                );
        }
        $results = array(
            "sEcho"=>1, //Información para el datatables
            "iTotalRecords"=>count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
            "aaData"=>$data);
        echo json_encode($results);
 
    break;
 
    case 'selectSocio':
        require_once "../modelos/Socio.php";
        $socio = new Socio();
 
        $rspta = $socio->listar();
        echo '<option value=' . $reg->idsocio . '>Seleccione el Asociado </option>';
 
        while ($reg = $rspta->fetch_object())
            {
                echo '<option value=' . $reg->idsocio . '>' . $reg->nsocio . ' - ' . $reg->nombre. '</option>';
            }
	break;
		
	case 'selectContrato':
        require_once "../modelos/Contrato.php";
        $contrato = new Contrato();
 
        $rspta = $contrato->listar();
 
        while ($reg = $rspta->fetch_object())
            {
                echo '<option value=' . $reg->idcontrato . '>' . $reg->ncontrato . '</option>';
            }
    break;

    case 'selectContratos':
        require_once "../modelos/Contrato.php";
        $contrato = new Contrato();
        $idsocio=$_GET['idsocio'];
 
        $rspta = $contrato->listarContratos($idsocio);
        echo '<option>Seleccione el contrato</option>';
 
        while ($reg = $rspta->fetch_object())
            {                
                echo '<option value=' . $reg->idcontrato . '>' . $reg->ncontrato . '</option>';
            }
    break;

    case 'selectSemanas':
        require_once "../modelos/Ingreso.php";        

        $ingreso = new Ingreso();
        $ncontrato=$_GET['ncontrato'];
 
        $rspta = $ingreso->listarSemanas($ncontrato);
        
        while ($reg = $rspta->fetch_object())
            {
                echo $reg->semanas;
            }
    break;

 
    case 'listarPlanc':
        require_once "../modelos/Planc.php";
        $planc=new Planc();
 
        $rspta=$planc->listarActivos();
        //Vamos a declarar un array
        $data= Array();
 
        while ($reg=$rspta->fetch_object()){
            $data[]=array(
                "0"=>'<button class="btn btn-warning" onclick="agregarDetalle('.$reg->idplanc.',\''.$reg->nombre.'\')"><span class="fa fa-plus"></span></button>',
                "1"=>$reg->nombre,
				"2"=>$reg->codigo);
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