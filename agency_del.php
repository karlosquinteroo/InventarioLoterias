<?php 

session_start();
include("conex.php");
$linbd=conectar();


echo $id_agen=$_POST["id_agen"];
$query_ba="UPDATE `m040_agencia` SET `CO_ESTADO`= 0 WHERE co_agencia = '$id_agen' ";

	$sql_ba= mysql_query($query_ba) or die( mysql_error() );
	if(mysql_affected_rows()>0){
		echo"Agencia desincorporada exitosamente";
		}
		else{ echo "Error al desincorporar agencia";}


?>