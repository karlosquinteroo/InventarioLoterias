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
	 
	 $sw_bdel_art=$_GET["sw_bdel_art"];
	 $serial_busqueda=$_GET["serial_busqueda"];


if( $sw_bdel_art = 0 )
{
	$query_res="SELECT * FROM `m080_articulo` WHERE co_serial_articulo = '$serial_busqueda' limit 1";
            $sql= mysql_query($query_res); 
            $res_o = mysql_fetch_array( $sql);
	?>
	       
 <?php 
}
?>