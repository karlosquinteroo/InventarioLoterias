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

        $query_proveedor="select co_proveedor, nb_nombre_proveedor
                          from m0100_proveedor;";             
        $sql_proveedor= mysql_query($query_proveedor);

        $query_tipo_articulo="SELECT co_tipo_articulo, tx_desc_tipo_articulo FROM p070_tipo_articulo;";             
        $sql_tipo_articulo= mysql_query($query_tipo_articulo);
         
        $query_agencia_almacen="select m040_agencia.co_agencia , concat (  m040_agencia.nb_agencia, concat( ' (',concat( p030_municipio.nb_ciudad ,' )' ) )  ) 
                                from m040_agencia, p030_municipio 
                                where co_agencia_principal =1 and
                                p030_municipio.co_municipio = m040_agencia.co_municipio;";             
        $sql_agencia_almacen= mysql_query($query_agencia_almacen);

        $query_tipo_ingreso="select co_tipo_ingreso, tx_desc_tipo_ingreso  from p0110_tipo_ingreso;";             
        $sql_tipo_ingreso= mysql_query($query_tipo_ingreso);
        
        $numero=array();
        for( $j=1; $j<100; $j++ ) 
        {
            $numero[$j]=$j;
        }
?>
    
<div id="header">
<?php include("header.php"); ?>
</div>

</head>
<body>

<!-- add provee -->
<div class="well1" id="addmore">
    <ul class="thumbnails">
        <h3 style="margin-left: 200px;">ingresar proveedor</h3>
        <div class="row-fluid" style="margin-left: 200px; margin-top: 5px; width: 250px; float: left;">
            <div style="float: right; position: absolute; margin-left: 480px; margin-top: 10px;"><!-- boton de aceptar -->
                <button class="btn btn-large" onclick="up_div_pro()">aceptar</button>
            </div>
            <!-- boton de aceptar -->
            <label>proveedor ya existe?</label>
            <div class="input-control text" data-role="input-control">
                <select id="provexist" name="provexist" onchange="mostrar_formulario(this)">
                    <option value="0">No...</option>
                    <?php
                        while( $res_proveedor = mysql_fetch_array( $sql_proveedor ) )
                        {
                            echo "<option value='".$res_proveedor[0]."'> ".$res_proveedor[1]." </option>";
                        }
                    ?>
                </select>
            </div>
            <div id="proveedor_existente" style="">
                <label>nombre</label>
                <div class="input-control text" data-role="input-control">
                    <input type="text" id="nombreprov" name="nombreprov" placeholder="Nombre Proveedor">
                </div>
                <label>direccion</label>
                <div class="input-control text" data-role="input-control">
                    <input type="text" id="direcprov" name="direcprov" placeholder="Direccion">
    			</div>
    			<label>telefono</label>
    			<div class="input-control text" data-role="input-control">
    				<input type="text" id="telefprov" name="telefprov" placeholder="Telefono">
    			</div>
    			<label>rif</label>
    			<div class="input-control text" data-role="input-control">
    				<input type="text" id="rifprov" name="rifprov" placeholder="Rif">
                    <input type="hidden" spellcheck="false" id="flag" name="flag" value="1">
    			</div>
    			<label>municipio</label>
                <div class="input" data-role="input-control">
                    <select id="muniprov" name="muniprov" >
                        <option value="0">seleccione</option>
                        <?php
                            while( $res = mysql_fetch_array( $sql ) ) 
                            {
                                echo "<option value='".$res[0]."'> ".$res[1]." </option>";
                            }
                        ?>
    				</select>
    			</div>
            </div>
		</div>
        <div class="container-fluid cont" style="margin-top: 10px; width: 250px; margin-left: 400px;">
            <div class="row-fluid">
                <li><label>tipo de ingreso</label>
                    <div class="input-control text" data-role="input-control">
                        <select id="tipo_ingreso" name="tipo_ingreso" onChange="mostraringreso(this)">
                            <option value="0">Seleccione</option>
                            <?php
                                while( $res_tipo_ingreso = mysql_fetch_array( $sql_tipo_ingreso ) ) 
                                {
                                    echo "<option value='".$res_tipo_ingreso[0]."'> ".$res_tipo_ingreso[1]." </option>";
                                } 
                            ?>
                        </select>
                    </div>
                </li>  
            </div>
        </div>
	</ul>	
</div>

<!-- add provee -->

<!-- add article -->
<div class="container cont cent" style="margin-top:25px;">
    <div class="well" style="margin-top: 80px;">
        <div class="container-fluid cont" style="margin-top: 5px; width: 250px; float: left;">
            <h4>agregar articulos</h4>
            <div class="row-fluid">
                <div style="float: right; position: absolute; margin-left: 800px; margin-top: 250px;"><!-- boton de aceptar -->
                    <button class="btn btn-warning btn-large" onclick="add_article()">aceptar</button>
                    <div id="resultado">
                        <div id="div_carga" style="position: absolute; margin-top: 5%; margin-left: 35%; display:none;">
                            <img id="cargador" src="img/ajax-loader.gif"/>
                        </div>
                    </div>
            	</div><!-- boton de aceptar -->
                <div style="float: right; position: absolute; margin-left: 800px; margin-top: 0px;"><!-- proveedor-->
                    <label>Proveedor actual</label>
                    <label for="me"></label>
                    <label onClick="down_div_pro()"> <u>Cambiar proveedor?</u> </label>
                </div><!-- proveedor -->
                <li><label>serial</label>
                    <div class="input-control text" data-role="input-control">
            			<input type="text" id="serial" name="serial" placeholder="Serial">
            		</div>
                </li>
                <li><label>descripcion</label>
                    <div class="input-control text" data-role="input-control">
            			<input type="text" id="descrip" name="descrip" placeholder="Descripcion">
            		</div>
                </li>
                <li><label>precio</label>
        			<div class="input-control text" data-role="input-control">
            			<input type="text" id="precio" name="precio" placeholder="Precio">
            		</div>
                </li>
            	<li><label>almacen</label>
        			<div class="input-control text" data-role="input-control">
            			<select id="almacen" name="almacen">
            				<option value="0">seleccione</option>
            				<?php
                                while( $res_agencia_almacen = mysql_fetch_array( $sql_agencia_almacen ) ) 
                                {
                                    echo "<option value='".$res_agencia_almacen[0]."'> ".$res_agencia_almacen[1]." </option>";
                                } 
                            ?>
            			</select>
            		</div>
                </li>
            	<li><label>cantidad</label>
        			<div class="input-control text" data-role="input-control">
            			<select id="cantidad" name="cantidad" >
                        <?php
            				for( $i=1; $i<100; $i++ ) 
                            {
                                echo "<option value='".$numero[$i]."'> ".$numero[$i]." </option>";
                            }
                        ?>
            			</select>
            		</div>
                </li>
            </div>	
        </div>
        <div class="container-fluid cont" style="margin-top: 46px; width: 250px; margin-left: 400px;">
  			<div class="row-fluid">
            	<li><label>tipo de articulo</label>
        			<div class="input-control text" data-role="input-control">
            			<select id="tipo_articulo" name="tipo_articulo" onChange="mostrarsimcard(this)">
            				<option value="0">Seleccione</option>
            				<?php
                                while( $res_tipo_articulo = mysql_fetch_array( $sql_tipo_articulo ) ) 
                                {
                                    echo "<option value='".$res_tipo_articulo[0]."'> ".$res_tipo_articulo[1]." </option>";
                                } 
                            ?>
            			</select>
            		</div>
                </li>
                <div id="SimCard" style="display:none;">
                    <li><label>costo del plan</label>
                        <div class="input-control text" data-role="input-control">
                            <input type="text" id="costo_plan" name="costo_plan" placeholder="Especifique Articulo">
                        </div>
                    </li>
                    <li><label>fecha plan</label>
                        <div class="input-control text" data-role="input-control">
                            <input type="date" id="fecha_plan" name="fecha_plan" placeholder="Especifique Articulo">
                        </div>
                    </li>
                </div>
                <div id="Otros" style="display:none;">
            		<li> <label>especifique articulo</label>
                        <div class="input-control text" data-role="input-control">
            				<input type="text" id="detarti" name="detarti" placeholder="Especifique Articulo">
            			</div>
                    </li>
                </div>
            	<li><label>fabricante</label>
        			<div class="input-control text" data-role="input-control">
            			<input type="text" id="fabricante" name="fabricante" placeholder="Fabricante">
            		</div>
                </li>
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