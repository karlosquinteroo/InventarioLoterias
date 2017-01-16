<html>
<head>
	<title></title>
    <meta charset="UTF-16"/>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href="mb/css/metro-bootstrap.css">
	<link rel="stylesheet" href="mb/docs/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.theme.min.css">
	

    <script>
    </script>

    <?php
        session_start();
        $user=$_SESSION['usuario'];
        $password=$_SESSION['pass'];
        if( !isset( $_SESSION["autenticado"] ) )
        {
            header("location:index.php");
        }

        $fecha=date("y/m/d");
        include("conex.php"); 
        $linbd=conectar(); 

        $query_tipo="SELECT p070_tipo_articulo.co_tipo_articulo, p070_tipo_articulo.tx_desc_tipo_articulo 
        from p070_tipo_articulo";             
        $sql_tipo= mysql_query($query_tipo); 

        $query_edo="SELECT p060_edo_articulo.co_edo_articulo, p060_edo_articulo.tx_desc_edo_articulo
        from p060_edo_articulo";             
        $sql_edo= mysql_query($query_edo);

        $query_agencia="SELECT co_agencia, nb_agencia FROM `m040_agencia` ";             
        $sql_agencia= mysql_query($query_agencia);   
    ?>

    <script type="text/javascript">
   

    </script>

</head>
<body>

<div id="header">
<?php include("header.php"); ?>
</div>


<!-- add article -->
    <div class="container cont cent" style="margin-top:25px;">
        <div class="well" style="margin-top: 80px;">
            <div class="container-fluid cont" style="margin-top: 5px; width: 250px;">
                    <h4>rastreo de articulo</h4>
                    <table class="table" id="table" width="900"style="margin-left:80px; ">
                        <tr>
                            <th align="center">
                                <label>codigo del articulo</label>
                                <div class="input-control text" data-role="input-control">
                                <input type="text" id="co_busqueda_art" name="co_busqueda_art" placeholder="Codigo del Articulo..." onKeyUp="track()">
                                </div>
                            </th>            
                        </tr>
                    </table>
                <div id="div_carga" style="position: absolute; margin-top: 5%; margin-left: 35%; display:none;">
                    <img id="cargador" src="img/ajax-loader.gif"/>
                </div>
                <div id="track_res"></div>         
            </div>   
        </div>
    </div>
<!-- add provee -->


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