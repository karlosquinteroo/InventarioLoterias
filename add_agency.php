<html>
<head>
	<title></title>
    <meta charset="UTF-16"/>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href="mb/css/metro-bootstrap.css">
	<link rel="stylesheet" href="mb/docs/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.theme.min.css">
	<script src="js/jsc.js"></script>

    <script>
     window.onload=down_div_pro;
    </script>

     <?php
        session_start();
        if( !isset( $_SESSION["autenticado"] ) )
        {
            header("location:index.php");
        }
        include("conex.php"); 
        $linbd=conectar();      
        $query="select co_municipio, concat ( p030_municipio.nb_ciudad, concat( ' (',concat( m020_estado.nb_estado ,' )' ) )  )
                from p030_municipio, m020_estado
                where p030_municipio.co_estado = m020_estado.co_estado;";             
        $sql= mysql_query($query);
?>

</head>
<body>

<div id="header">
<?php include("header.php"); ?>
</div>


<!-- add article -->
	<div class="container cont cent" style="margin-top:25px;">
    	<div class="well" style="margin-top: 80px;">
        	<div class="container-fluid cont" style="margin-top: 5px; width: 250px; float: left;">
        			<h4>agregar agencia</h4>
  				<div class="row-fluid">
  					<!-- boton de aceptar -->
					<div style="float: right; position: absolute; margin-left: 400px; margin-top: 250px;">
                		<button class="btn btn-warning btn-large" onclick="add_agency()">aceptar</button>
                        <div id="resultado_add"></div>
            		</div>
            		<!-- boton de aceptar -->
      				<li><label>nombre y codigo</label>
        				<div class="input-control text" data-role="input-control">
            				<input type="text" id="nombre_agen" placeholder="nombre" style="width:65%;">-
                            <input type="text" id="code_agen" placeholder="codigo" style="width:25%;">
            			</div></li>
            		<li><label>direccion</label>
        				<div class="input-control text" data-role="input-control">
            				<input type="text" id="direccion_agen" placeholder="direccion">
            			</div></li>
            		<li><label>telefono</label>
        				<div class="input-control text" data-role="input-control">
            				<input type="text" id="telefono_agen" placeholder="telefono">
            			</div></li>
                    <li><label>rif</label>
                        <div class="input-control text" data-role="input-control">
                            <input type="text" id="rif_agen" placeholder="rif">
                        </div></li>
                    <li><label>encargado</label>
                        <div class="input-control text" data-role="input-control">
                            <input type="text" id="encar_agen" placeholder="encargado">
                        </div></li>
            	</div>	
        	</div>
        <div class="container-fluid cont" style="margin-top: 46px; width: 250px; margin-left: 400px;">
  				<div class="row-fluid">
            		<label>municipio</label>
                <div class="input" data-role="input-control">
                    <select id="muni_agen" name="muniprov" >
                        <option>seleccione</option>
                        <?php
                            while( $res = mysql_fetch_array( $sql ) ) 
                            {
                                echo "<option value='".$res[0]."'> ".$res[1]." </option>";
                            }
                        ?>
                    </select>
                </div>
            		<li><label>es agencia principal?</label>
                        <div class="input-control text" data-role="input-control">
                            <select id="agen_pri" >
                                <option value="0">seleccione</option>
                                <option value="1">si</option>
                                <option value="2">no</option>
                            </select>
                        </div></li>
            		<li><label>correo</label>
        				<div class="input-control text" data-role="input-control">
            				<input type="text" id="correo_agen" placeholder="correo">
            			</div></li>
            	</div>	
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