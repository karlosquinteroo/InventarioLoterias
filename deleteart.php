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
    <script src="js/jquery.min.js"></script>

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
        if( isset($_GET["co_busqueda"] ))
        {
            $serial_busqueda=$_GET["co_busqueda"];
            $query_res="SELECT m080_articulo.co_articulo, m080_articulo.co_serial_articulo, m080_articulo.tx_descripcion_articulo,  x.nb_agencia, m040_agencia.nb_agencia, p060_edo_articulo.tx_desc_edo_articulo 
                        from t090_detalle_movimiento, t050_movimiento, m080_articulo, p060_edo_articulo, p0140_tipo_mov, m040_agencia, m040_agencia x
                        where 
                            t090_detalle_movimiento.co_articulo = '$serial_busqueda' and
                            t090_detalle_movimiento.co_articulo = m080_articulo.co_articulo and 
                            t090_detalle_movimiento.co_movimiento = t050_movimiento.co_movimiento and 
                            m080_articulo.co_edo_articulo = p060_edo_articulo.co_edo_articulo and 
                            t050_movimiento.co_tipo_mov = p0140_tipo_mov.co_tipo_mov and 
                            t050_movimiento.co_agencia_movdest = m040_agencia.co_agencia and 
                            t050_movimiento.co_agencia_movorig = x.co_agencia
                            order by t090_detalle_movimiento.fe_mov desc limit 1";
            $sql= mysql_query($query_res); 
            $res_o = mysql_fetch_array( $sql);
        }
        if( isset($_GET["id_1"] ) )
        {
            if($_GET["id_1"] == "")
            {
            }
            else
            {
                $id=$_GET["id_1"];
                $agregar_mov=mysql_query("INSERT INTO `loteria`.`t050_movimiento` 
                    (
                        `CO_movimiento`, 
                        `CO_USUARIO_MOV`, 
                        `CO_AGENCIA_MOVDEST`, 
                        `CO_AGENCIA_MOVORIG`, 
                        `CO_TIPO_MOV`
                    )    
                    values 
                    ('null',
                    (SELECT co_usuario FROM m010_usuario where NB_NOMBRE_USUARIO = '$user' AND pw_password = '$password' ),
                    1,
                    1,
                    13);");

                $agregar_det_mov=mysql_query("INSERT INTO `loteria`.`t090_detalle_movimiento` (
                `CO_detalle_mov`, 
                `FE_MOV`, 
                `CO_MOVIMIENTO`, 
                `CO_ARTICULO`
                )    
                values('null', '$fecha',(SELECT CO_movimiento FROM t050_movimiento order by CO_movimiento desc limit 1),
                '$id' );");

                $update_art=mysql_query("UPDATE `m080_articulo` SET co_edo_articulo =6 WHERE co_articulo ='$id' ");

                if(mysql_affected_rows()>0)
                {
                    $reporte="Articulo desincorporado exitosamente";     
                }
            }
        } 
    ?>
    

</head>
<body>

<div id="header">
<?php include("header.php"); ?>
</div>

<!-- add article -->
<form id="form1" name="form1" method="get" action="">	
    <div class="container cont cent" style="margin-top:25px;">
    	<div class="well" style="margin-top: 80px;">
                <div class="container-fluid cont" style="margin-top: 5px; width: 250px; float: left; margin-left: 100px;">
            			<h3>desincorporar articulos</h3>
      				<div class="row-fluid">
      					<!-- boton de buscar para eliminar -->
    					<div style="float: right; position: absolute; margin-left: 60px; margin-top: 120px;">
                    		<button class="btn btn-warning btn-large" onclick="">buscar</button>
                		</div>
                		<!-- boton de buscar para eliminar -->
                		<label>codigo del articulo</label>
            				<div class="input-control text" data-role="input-control">
                				<input type="text" id="co_busqueda" name="co_busqueda" placeholder="Codigo del Articulo...">
                			</div>
                	</div>	
            	</div>
</form>
<div id="result_busqueda" class="container-fluid cont" style="margin-top: 46px; width: 250px; margin-left: 600px; ">
			<div class="row-fluid">
				<!-- boton de aceptar eliminar -->
			<div style="float: right; position: absolute; margin-left: 300px; margin-top: 160px;">
        		<button class="btn btn-warning btn-large" onclick="">desincorporar</button>
                <label> <?php if(isset($reporte)){echo $reporte;}?> </label>
    		</div>
    		<!-- boton de aceptar eliminar -->
				<label>serial</label>
				<div class="input-control text" data-role="input-control">
    				<input id="serial_1" type="text" placeholder="" readonly="true" style="cursor:default;" value=<?php if(isset($res_o[0])) {echo $res_o[1] ;}?> >
    			</div>
            <label>id</label>
                <div class="input-control text" data-role="input-control">
                    <input id="id_1" name="id_1" type="text" placeholder="" readonly="true" style="cursor:default;" value=<?php if(isset($res_o[0])) {echo $res_o[0] ;}?> >
                </div>
    		<label>descripcion</label>
				<div class="input-control text" data-role="input-control">
    				<input id="descripcion_1" type="text" placeholder="" readonly="true" style="cursor:default;" value=<?php if(isset($res_o[0])) {echo $res_o[2] ;}?> >
    			</div>
    		<label>ubicacion</label>
				<div class="input-control text" data-role="input-control">
    				<input id="ubicacion_1" type="text" placeholder="" readonly="true" style="cursor:default;" value=<?php if(isset($res_o[0])) {echo $res_o[4] ;}?> >
    			</div>
    		<label>condicion</label>
				<div class="input-control text" data-role="input-control">
    				<input id="condicion_1" type="text" placeholder="" readonly="true" style="cursor:default;" value=<?php if(isset($res_o[0])) {echo $res_o[5] ;}?> >
    			</div>
    		<label>ultima agencia</label>
				<div class="input-control text" data-role="input-control">
    				<input id="ultima_1" type="text" placeholder="" readonly="true" style="cursor:default;" value=<?php if(isset($res_o[0])) {echo $res_o[3] ;}?> >
    			</div>
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