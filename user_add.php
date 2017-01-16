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
        
        $query_agencia_almacen="select m040_agencia.co_agencia , concat (  m040_agencia.nb_agencia, concat( ' (',concat( p030_municipio.nb_ciudad ,' )' ) )  ) 
                                from m040_agencia, p030_municipio 
                                where co_agencia_principal =1 and
                                p030_municipio.co_municipio = m040_agencia.co_municipio;";             
        $sql_agencia_almacen= mysql_query($query_agencia_almacen);

        $numero=array();
        $admin=array("","Seleccione","usuaio","administrador",);
        for( $j=1; $j<100; $j++ ) 
        {
            $numero[$j]=$j;
        }
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
            <h3>agregar usuarios</h3>
            <div class="row-fluid">
                <div style="float: right; position: absolute; margin-left: 700px; margin-top: 250px;"><!-- boton de aceptar -->
                    <button class="btn btn-warning btn-large" onclick="add_user()">aceptar</button>
                    <div id="resultado_user"></div>
            	</div><!-- boton de aceptar -->
                <li><label>P nombre</label>
                    <div class="input-control text" data-role="input-control">
            			<input type="text" id="pnombre" name="pnombre" placeholder="P nombre">*
            		</div>
                </li>
                <li><label>S nombre</label>
                    <div class="input-control text" data-role="input-control">
            			<input type="text" id="snombre" name="snombre" placeholder="S nombre">
            		</div>
                </li>
                <li><label>P apellido</label>
        			<div class="input-control text" data-role="input-control">
            			<input type="text" id="papellido" name="papellido" placeholder="P apellido">*
            		</div>
                </li>
                <li><label>S apellido</label>
                    <div class="input-control text" data-role="input-control">
                        <input type="text" id="sapellido" name="sapellido" placeholder="S apellido">
                    </div>
                </li>
                <li><label>documento de identidad</label>
                    <div class="input-control text" data-role="input-control">
                        <input type="text" id="ci" name="ci" placeholder="documento de identidad">*
                    </div>
                </li>
            	<li><label>prioridad</label>
        			<div class="input-control text" data-role="input-control">
            			<select id="prioridad" name="prioridad" >
                        <option value="0"> seleccione </option>";
                        <option value="1"> usuario </option>";
                        <option value="2"> administrador </option>";
            			</select>*
            		</div>
                </li>
            </div>	
        </div>
        <div class="container-fluid cont" style="margin-top: 46px; width: 250px; margin-left: 400px;">
  			<div class="row-fluid">
            	<li><label>correo</label>
                    <div class="input-control text" data-role="input-control">
                        <input type="text" id="correo" name="correo" placeholder="correo">*
                    </div>
                </li>
                <li><label>telefono</label>
                    <div class="input-control text" data-role="input-control">
                        <input type="text" id="telefono" name="telefono" placeholder="telefono">*
                    </div>
                </li>
                <li><label>fecha de nacimiento</label>
                    <div class="input-control text" data-role="input-control">
                        <input type="date" id="fnacimiento" name="fnacimiento" placeholder="Precio">*
                    </div>
                </li>
                <li><label>agencia</label>
                    <div class="input-control text" data-role="input-control">
                        <select id="agencia" name="agencia">
                            <option>seleccione</option>
                            <?php
                                while( $res_agencia_almacen = mysql_fetch_array( $sql_agencia_almacen ) ) 
                                {
                                    echo "<option value='".$res_agencia_almacen[0]."'> ".$res_agencia_almacen[1]." </option>";
                                } 
                            ?>
                        </select>*
                    </div>
                </li>
                <h5>(*) Campos Obligatorios</h5>
            </div>	
        </div>
	</div>
</div>
<!-- add article -->



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