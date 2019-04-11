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

//Inlcuímos a la clase PDF_MC_Table
require('PDF_MC_Table.php');
 
//Instanciamos la clase para generar el documento pdf
$pdf=new PDF_MC_Table();
 
//Agregamos la primera página al documento pdf
$pdf->AddPage();
 
//Seteamos el inicio del margen superior en 25 pixeles 
$y_axis_initial = 25;
 
//Seteamos el tipo de letra y creamos el título de la página. No es un encabezado no se repetirá
$pdf->SetFont('Arial','B',12);

$pdf->Cell(40,6,'',0,0,'C');
$pdf->Cell(100,6,'LISTA DE ASOCIADOS',1,0,'C'); 
$pdf->Ln(10);
 
//Creamos las celdas para los títulos de cada columna y le asignamos un fondo gris y el tipo de letra
$pdf->SetFillColor(232,232,232); 
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,6,utf8_decode('N°'),1,0,'C',1); 
$pdf->Cell(15,6,utf8_decode('T.P'),1,0,'C',1);
$pdf->Cell(60,6,utf8_decode('Nombres y Apellidos'),1,0,'C',1);
$pdf->Cell(20,6,utf8_decode('T.D'),1,0,'C',1);
$pdf->Cell(35,6,utf8_decode('N° de Documento'),1,0,'C',1);
$pdf->Cell(50,6,utf8_decode('Dirección'),1,0,'C',1);
$pdf->Cell(25,6,utf8_decode('Telefono'),1,0,'C',1);
$pdf->Cell(35,6,utf8_decode('Fecha Insc.'),1,0,'C',1);
$pdf->Cell(20,6,utf8_decode('Condición'),1,0,'C',1);
 
$pdf->Ln(10);
//Comenzamos a crear las filas de los registros según la consulta mysql
require_once "../modelos/Socio.php";
$socio = new Socio();

$rspta = $socio->listar();

//Table with 20 rows and 4 columns
$pdf->SetWidths(array(10,15,60,20,35,50,25,35,20));

while($reg= $rspta->fetch_object())
{  
    $nsocio = $reg->nsocio;
    $tipo_persona = $reg->tipo_persona;
    $nombre = $reg->nombre;
    $tipo_documento = $reg->tipo_documento;
    $num_documento =$reg->num_documento;
    $direccion = $reg->direccion;
    $telefono = $reg->telefono;
    $fecha_ins = $reg->fecha_ins;
    $condicion = $reg->condicion;
 	
 	$pdf->SetFont('Arial','',10);
    $pdf->Row(array(utf8_decode($nsocio),utf8_decode($tipo_persona),utf8_decode($nombre),utf8_decode($tipo_documento),utf8_decode($num_documento),utf8_decode($direccion),utf8_decode($telefono),utf8_decode($fecha_ins),utf8_decode($condicion)));
}
 
//Mostramos el documento pdf
$pdf->Output();

?>
<?php
}
else
{
  echo 'No tiene permiso para visualizar el reporte';
}

}
ob_end_flush();
?>