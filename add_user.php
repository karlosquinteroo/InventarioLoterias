<script src="js/jquery.min.js"></script>
<script src="mb/docs/bootstrap-transition.js"></script>
<script src="mb/docs/bootstrap-alert.js"></script>
<script src="mb/docs/bootstrap-modal.js"></script>
<script src="mb/docs/bootstrap-dropdown.js"></script>
<script src="mb/docs/bootstrap-scrollspy.js"></script>
<script src="mb/docs/bootstrap-tab.js"></script>
<script src="mb/docs/bootstrap-tooltip.js"></script>
<script src="mb/docs/bootstrap-popover.js"></script>
<script src="mb/docs/bootstrap-button.js"></script>
<script src="mb/docs/bootstrap-collapse.js"></script>
<script src="mb/docs/bootstrap-carousel.js"></script>
<script src="mb/docs/bootstrap-typeahead.js"></script>
<script src="js/jsc.js"></script>
<script src="js/1.3.1jquery.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery-2.1.1.min.js"></script>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jquery.js"></script>
<script type="text/javascript" src="js/jqueryui.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="mb/css/metro-bootstrap.css">
<link rel="stylesheet" href="mb/docs/font-awesome.css">
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/jquery-ui.theme.min.css">
<script src="js/jsc.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/jquery-1.5.2.js" type="text/javascript"></script>

<?php  
session_start();
include("conex.php");
$linbd=conectar();
 
$pnombre=ucwords($pnombre=$_POST["pnombre"]);
$snombre=ucwords($snombre=$_POST["snombre"]);
$papellido=ucwords($papellido=$_POST["papellido"]);
$sapellido=ucwords($sapellido=$_POST["sapellido"]);
$ci=$_POST["ci"];
$prioridad=$_POST["prioridad"];
$correo=$_POST["correo"];
$telefono=$_POST["telefono"];
$fnacimiento=$_POST["fnacimiento"];
$agencia=$_POST["agencia"];
$nusuario=$_POST["nusuario"];
$pass=$_POST["pass"];


$agregar_ingreso=mysql_query
	("INSERT INTO `m010_usuario`(`CO_USUARIO`, `NU_CEDULA`, `NB_PAPELLIDO`, `NB_SAPELLIDO`, `NB_PNOMBRE`, `NB_SNOMBRE`, `NB_NOMBRE_USUARIO`, `CO_PRIORIDAD`, `CE_USUARIO`, `FN_NACIMIENTO`, `PW_PASSWORD`, `NU_TELEFONO`, `CO_AGENCIA`) 
	VALUES ('null','$ci','$papellido','$sapellido','$pnombre','$snombre','$nusuario','$prioridad','$correo','$fnacimiento','$pass','$telefono','$agencia')");	


	if(mysql_affected_rows()>0)
	{
        echo "Usuario agregado exitosamente ";
        echo "usurio: ";
        echo $nusuario; 
        echo " Pass: ";
        echo $pass;   
    }
    else
    { 
        echo "Error Al agregar nuevo usuario";
    }  
?>