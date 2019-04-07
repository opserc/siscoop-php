<?php
//Activamos el almacenamiento en el buffer
ob_start();
if (strlen(session_id()) < 1) 
  session_start();

if (!isset($_SESSION["nombre"]))
{
  echo 'Debe ingresar al sistema correctamente para visualizar el reporte';
}
else
{
if ($_SESSION['asociados']==1)
{
//Incluímos el archivo Factura.php
require('Gcontrato.php');

//Establecemos los datos de la empresa
$logo = "coop.jpg";
$ext_logo = "jpg";
$empresa = "Asociacion Cooperativa Mixta Loyola R,L";
$documento = "J-30155000-5";
$direccion = "Callejon Paraiso, entre Carr. 16 El Rosario y Av. Castañeda";
$telefono = "(0252) - 421.11.34";
$email = "loyola.asociados1970@gmail.com";

//Obtenemos los datos de la cabecera de la venta actual
require_once "../modelos/Contrato.php";
$contrato= new Contrato();
$rsptav = $contrato->contratocabecera($_GET["id"]);
//Recorremos todos los valores obtenidos
$regv = $rsptav->fetch_object();

//Establecemos la configuración de la factura
$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();

//Enviamos los datos de la empresa al método addSociete de la clase Factura
$pdf->addSociete(utf8_decode($empresa),
                  $documento."\n" .
                  utf8_decode("Dirección: ").utf8_decode($direccion)."\n".
                  utf8_decode("Teléfono: ").$telefono."\n" .
                  "Email : ".$email,$logo,$ext_logo);
$pdf->fact_dev( utf8_decode("N° de Contrato: "), "$regv->ncontrato" );
$pdf->temporaire( "" );

//Enviamos los datos del cliente al método addClientAdresse de la clase Factura
$pdf->addClientAdresse(utf8_decode($regv->nombre),$regv->tipo_documento,$regv->num_documento,"Direccion: ".utf8_decode($regv->direccion),"Telefono: ".$regv->telefono,"Fecha Insc.: ".$regv->fecha);

//Establecemos las columnas que va a tener la sección donde mostramos los detalles de la venta
$cols=array( "NOMBRES Y APELLIDOS"=>50,
             "DOCUMENTO"=>35,
             "F. NACIMIENTO"=>35,
             "F. INSCRIPCION"=>35,
             "F. DE SERVICIO"=>35);
$pdf->addCols( $cols);
$cols=array( "NOMBRES Y APELLIDOS"=>"C",
             "DOCUMENTO"=>"C",
             "F. NACIMIENTO"=>"C",
             "F. INSCRIPCION"=>"C",
             "F. DE SERVICIO" =>"C");
$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols);
//Actualizamos el valor de la coordenada "y", que será la ubicación desde donde empezaremos a mostrar los datos
$y= 89;

 //Obtenemos todos los detalles de la venta actual
$rsptad = $contrato->contratodetalle($_GET["id"]);

while ($regd = $rsptad->fetch_object()) {
  $line = array( "NOMBRES Y APELLIDOS"=> "$regd->nombre",
                "DOCUMENTO"=> "$regd->num_documento",
                "F. NACIMIENTO"=> "$regd->fecha",
                "F. INSCRIPCION"=> "0000-00-00",
                "F. DE SERVICIO" => "0000-00-00");
            $size = $pdf->addLine( $y, $line );
            $y   += $size + 2;
}
/*
//Convertimos el total en letras
require_once "Letras.php";
$V=new EnLetras(); 
$con_letra=strtoupper($V->ValorEnLetras($regv->total_venta,"NUEVOS SOLES"));
$pdf->addCadreTVAs("---".$con_letra);

//Mostramos el impuesto
$pdf->addTVAs( $regv->impuesto, $regv->total_venta,"S/ ");
$pdf->addCadreEurosFrancs("IGV"." $regv->impuesto %");

*/
$pdf->Output('Contrato','I');
}
else
{
  echo 'No tiene permiso para visualizar el reporte';
}

}
ob_end_flush();
?>