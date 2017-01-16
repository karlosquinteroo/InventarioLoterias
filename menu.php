<html>
<head>
	<title></title>
    <meta charset="UTF-8"/>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href="mb/css/metro-bootstrap.css">
	<link rel="stylesheet" href="mb/docs/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.theme.min.css">
	<script src="js/jsc.js"></script>
	<?php  
		session_start();
        if( !isset( $_SESSION["autenticado"] ) )
        {
            header("location:index.php");
        }
		?>

        <script>
     window.onload=down_div_auth;
    </script>
</head>
<body>
<h1 class="brand">Menú principal</h1>

  <div class="container cont cent" id="contenedor_m">
    <div class="well">
      <ul class="thumbnails">
	    <li class="span3 tile tile-double" id="tile+">
	        <a href="addarticle.php" >
	            <img src="img/add.png">
	            <h5>agregar nuevos artículos</h5>
	        </a>
	    </li>
	    <li class="span3 tile tile-teal" id="del">
	        <a href="deleteart.php" >
	            <img src="img/clear.png">
	            <h5>desincorporar artículos</h5>
	        </a>
	    </li>
	    <li class="span3 tile tile-orange tile-double" id="asig">
			<a href="assign.php">
				<img src="img/addall.png" alt="">
				<h5>asignar</h5>
			</a>
	    </li>
	    <li class="span3 tile tile-red" id="inv">
	        <a href="invent.php" >
	            <img src="img/list.png">
	            <h5>inventario</h5>
	        </a>
	    </li>
	      <li class="span3 tile tile-orange tile-double">
	    	<a href="agency.php">
	    		<img src="img/home.png" alt="">
	    		<h5>agencias</h5>
	    	</a>
	    </li>
	    <li class="span3 tile tile-yellow">
	        <a href="update.php" >
	            <img src="img/refresh.png">
	            <h5>actualizar</h5>
	        </a>
	    </li>
	    <li class="span3 tile tile-lime">
	        <a href="notify.php" >
	            <img src="img/alert.png">
	            <h5>notificaciones</h5>
	        </a>
	    </li>
	    <li class="span3 tile tile-purple tile-double">
	        <a href="user_add.php" >
	            <img src="img/user.png">
	            <h5>nuevo usuario</h5>
	        </a>
	    </li>
	     </li>
	    <li class="span3 tile tile-teal" id="del">
	        <a href="advandcequest.php" >
	            <img src="img/magnifybrowse.png">
	            <h5>busqueda avanzada</h5>
	        </a>
	    </li>
	    <li class="span3 tile tile-red">
	        <a href="track_article.php" >
	            <img src="img/rute.png">
	            <h5>ruta artículos</h5>
	        </a>
	    </li>
	    <li class="span3 tile tile-lime tile-double">
	        <a href="downloads.php" >
	            <img src="img/pdf.png">
	            <h5>descargas</h5>
	        </a>
	    </li>
	     <li class="span3 tile tile-red">
	        <a href="salir.php" >
	            <img src="img/exit.png">
	            <h5>salir</h5>
	        </a>
	    </li>
	    <li class="span3 tile tile-orange tile-double" id="asig">
			<a href="agency_estatus.php">
				<img src="img/det_home.png" alt="">
				<h5>Detalle de agencias</h5>
			</a>
	    </li>
	    
	  </ul>
    </div>

  </div>



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


</body>

</html>