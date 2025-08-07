<?php include("frases.php"); ?>
<?php include("items.php"); ?>
<?php include("datos_receptor.php"); ?>
<?php include("datos_generales.php"); ?>
<?php include("datos_emisor.php"); ?>
<?php include("impuesto_detalle.php"); ?>
<?php include("total_impuestos.php"); ?>
<?php include("complemento_exportacion.php"); ?>
<?php include("complemento_cambiaria.php"); ?>
<?php include("complemento_especial.php"); ?>
<?php include("complemento_notas.php"); ?>
<?php include("anulacion_fel.php"); ?>
<?php include("documento_fel.php"); ?>
<?php include("totales.php"); ?>
<?php include("adenda.php"); ?>

<?php include("respuesta.php"); ?>
<?php include("generar_xml.php"); ?>

<?php include("conexion_servicio_fel.php"); ?>

<?php include ("respuesta_servicio_fel.php"); ?>

<?php include("servicio_fel.php"); ?>

<?php include('httpful.phar');  ?>

<?php include('firma_emsior.php');  ?>

<?php
 function p_log($log)
 {
 	echo($log."<br>");
 }
?>