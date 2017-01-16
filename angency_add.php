<?php  
session_start();
include("conex.php");
$linbd=conectar();

$nombre=ucwords($nombre=$_POST["nombre"]);
$direccion=ucwords($direccion=$_POST["direccion"]);
$telef=$_POST["telef"];
$rif=$_POST["rif"];
$encargado=ucwords($encargado=$_POST["encargado"]);
$municipio=$_POST["municipio"];
$princi=$_POST["princi"];
$correo=$_POST["correo"];
$fecha=date("y/m/d");


$agregar_articulo=mysql_query("INSERT INTO
`m040_agencia`(`CO_AGENCIA`, `NB_AGENCIA`, `NU_RIF`, `TX_DIRECCION`, `NU_TELEFONO`, `NB_ENCARGADO`, `FE_ENTRADA`, `CE_CORREO`, `CO_MUNICIPIO`, `CO_AGENCIA_PRINCIPAL`, `CO_ESTADO`)
 VALUES ('null','$nombre','$rif','$direccion','$telef','$encargado','$fecha','$correo','$municipio','$princi', 1); ");
if(mysql_affected_rows()>0)
{
        echo "Agencia agregada exitosamente";     
}
else
{
        echo "Algun error ha ocurrido";
}

?>