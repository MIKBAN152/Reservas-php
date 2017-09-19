<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("link_reservas.php");

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    	// collect value of input field
    	$nombre = $_POST['nombre'];
	$id_nmr = $_POST['id_nmr'];
	$pers_nmr = $_POST['pers_nmr'];
	$dias_nmr = $_POST['dias_nmr'];
	$tipo_hab = $_POST['tipo_hab'];
	$fecha_in = $_POST['fecha_in'];
	$ob_link_res = new link_reservas();
    	$response = $ob_link_res->ingresarReserva($nombre, $id_nmr, $pers_nmr, $dias_nmr, $tipo_hab, $fecha_in);
	print $response;
}
else
{
	$Req_Met = $_REQUEST['metodo'] or die('No existe ese metodo');
	if($Req_Met == "getrooms")
	{
		$ob_link_res = new link_reservas();
		$response = $ob_link_res->getRoomData();
		//echo "success";
		print $response;
	}
	else
	{
		echo "no existe ese metodo";
	}
//	if($Req_Met == "reservar")
//	{
//		$nombre=$_REQUEST['nombre'];
//		$id_nmr=$_REQUEST['id_nmr'];
//		$pers_nmr=$_REQUEST['pers_nmr'];
//		$dias_nmr=$_REQUEST['dias_nmr'];
//		$tipo_hab=$_REQUEST['tipo_hab'];
//		$fecha_in=$_REQUEST['fecha_in'];
//		$response = $ob_link_res->ingresarReserva($name, $id_nmr, $pers_nmr, $dias_nmr, $tipo_hab, $fecha_in);
//		print $response;
//	}
}
?>
