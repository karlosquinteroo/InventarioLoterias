<?php 
function conectar(){
$link=mysql_connect("mysql.hostinger.co","u803804155_carl","8OPL7Pe0Imz");
   if(!$link)
       echo "Error al conectar con el servidor";
   else{
       $linbd=mysql_select_db("u803804155_lote",$link);
	   if(!$linbd)
	      echo "Error al seleccionar la BD"; 
	   return $linbd;
   }
}

?>


