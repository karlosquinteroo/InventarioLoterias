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
        if( isset($_GET["co_actualiza"] ))
        {
            $co_actualizar=$_GET["co_actualiza"];
            $query_actua="SELECT m080_articulo.co_articulo, m080_articulo.co_serial_articulo, m080_articulo.nb_fabricante, m080_articulo.tx_descripcion_articulo, m080_articulo.nu_precio, p070_tipo_articulo.co_tipo_articulo,
                        p070_tipo_articulo.tx_desc_tipo_articulo, p060_edo_articulo.co_edo_articulo, p060_edo_articulo.tx_desc_edo_articulo
                        from m080_articulo, p060_edo_articulo, p070_tipo_articulo
                        where co_articulo ='$co_actualizar'  and
                        p060_edo_articulo.co_edo_articulo = m080_articulo.co_edo_articulo and 
                        p070_tipo_articulo.co_tipo_articulo = m080_articulo.co_tipo_articulo ";
            $sql= mysql_query($query_actua);

            $res_o = mysql_fetch_array( $sql);

            $query_tipo="SELECT p070_tipo_articulo.co_tipo_articulo, p070_tipo_articulo.tx_desc_tipo_articulo 
                    from p070_tipo_articulo";             
            $sql_tipo= mysql_query($query_tipo);

            $query_agencia="SELECT m040_agencia.nb_agencia, m040_agencia.co_agencia
            from m040_agencia, m080_articulo 
            where m080_articulo.co_articulo = '$co_actualizar' and 
            m080_articulo.ub_actual = m040_agencia.co_agencia;"; 

            $sql_agencia= mysql_query($query_agencia);
            $res_oo = mysql_fetch_array( $sql_agencia);

            $query_edo="SELECT p060_edo_articulo.co_edo_articulo, p060_edo_articulo.tx_desc_edo_articulo
                        from p060_edo_articulo";             
            $sql_edo= mysql_query($query_edo);
            
            
        }
        if( isset($_POST["id_"] ) )
        {
            if($_POST["id_"] == "")
            {
            }
            else
            {
                
 
               if($_POST["fabricante_actualizar"]==""||$_POST["precio_actualizar"]==""||$_POST["descripcion_actualizar"]=="")
               {
                    $reporte="Debe completar todos los campos...";
               }
               else
               {

                if( isset($_POST["fabricante_actualizar"] ) )
                {
                    if($_POST["fabricante_actualizar"]=="")
                    {
                        $fabricante=$_POST["fabricante_actual"];
                    }
                    else
                    {
                        $fabricante=$_POST["fabricante_actualizar"];
                    }
                }
                

                if( isset( $_POST["precio_actualizar"] ) )
                {
                    if($_POST["precio_actualizar"]=="")
                    {
                        $precio=$_POST["precio_actual"];
                    }
                    else
                    {
                        $precio=$_POST["precio_actualizar"];
                    }
                    
                }
                

                if( isset( $_POST["descripcion_actualizar"] ) )
                {
                    if($_POST["descripcion_actualizar"]=="")
                    {
                        $descripcion=$_POST["descripcion_actual"];
                    }
                    else
                    {
                        $descripcion=$_POST["descripcion_actualizar"];
                    }
                }
                

                if( isset( $_POST["tipo_actualizar"] ) )
                {
                    if( $_POST["tipo_actualizar"] =="seleccione" )
                    {
                        $tipo=$res_o[5];
                    }
                    else
                    {
                        $tipo=$_POST["tipo_actualizar"];
                    }   
                }
                

                if( isset( $_POST["estado_actualizar"] ) )
                {
                    if($_POST["estado_actualizar"] =="seleccione" )
                    {
                        $estado=$res_o[7];
                    }
                    else
                    {
                        $estado=$_POST["estado_actualizar"];    
                    }
                }

                $id=$_POST["id_"];
                $agencia_origen = $_POST["agencia_origen"];
                $agregar_mov=mysql_query("INSERT INTO `t050_movimiento`(`CO_movimiento`,`CO_USUARIO_MOV`,`CO_AGENCIA_MOVDEST`,`CO_AGENCIA_MOVORIG`,`CO_TIPO_MOV`) 
                values('null',(SELECT co_usuario FROM m010_usuario where NB_NOMBRE_USUARIO = '$user' AND pw_password = '$password' ),1,'$agencia_origen',14);") 
                or die("problema con el query movimiento"); echo mysql_error();;

                $agregar_det_mov=mysql_query("INSERT INTO `t090_detalle_movimiento` (`CO_detalle_mov`,`FE_MOV`,`CO_MOVIMIENTO`,`CO_ARTICULO`)
                values('null', '$fecha',(SELECT CO_movimiento FROM t050_movimiento order by CO_movimiento desc limit 1),'$id' );");

                $actualizar_articulo=mysql_query("UPDATE `m080_articulo` SET `NB_FABRICANTE`='$fabricante',`TX_DESCRIPCION_ARTICULO`='$descripcion',`NU_PRECIO`='$precio',`CO_EDO_ARTICULO`='$estado',`CO_TIPO_ARTICULO`='$tipo',`UB_ACTUAL`=1 WHERE co_articulo='$id' ")
                 or die("problema con el queryactualizar"); echo mysql_error();
                
                if(mysql_affected_rows()>0)
                {
                    $reporte="Articulo actualizado exitosamente";   
                }
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
                <div class="container-fluid cont" style="margin-top: 5px; width: 250px; float: left;">
            			<h3>actualizar articulos</h3>
      				<div class="row-fluid">
      					<!-- boton de buscar para eliminar -->
    					<div style="float: right; position: absolute; margin-left: 60px; margin-top: 120px;">
                    		<button class="btn btn-warning btn-large" onclick="">buscar</button>
                		</div>
                		<!-- boton de buscar para eliminar -->
                		<label>codigo del articulo</label>
            				<div class="input-control text" data-role="input-control">
                				<input type="text" id="co_actualiza" name="co_actualiza" placeholder="Codigo del Articulo...">
                			</div>
                	</div>	
            	</div>
</form>

<div id="result_actualizar" class="container-fluid cont" style="margin-top: -15px; width: 250px; display: inline-block;  ">
    <form id="form2" name="form2" method="post" action="">
	<div class="row-fluid">
			<label>serial</label>
			<div class="input-control text" data-role="input-control">
				<input id="serial_actual" type="text" placeholder="" readonly="true" style="cursor:default;" value=<?php if(isset($res_o[0])) {echo $res_o[1] ;}?> >
			</div>
        <label>id</label>
            <div class="input-control text" data-role="input-control">
                <input id="id_actual" name="" type="text" placeholder="" readonly="true" style="cursor:default;" value=<?php if(isset($res_o[0])) {echo $res_o[0] ;}?> >
            </div>
		<label>fabricante</label>
			<div class="input-control text" data-role="input-control">
				<input id="fabricante_actual" name="fabricante_actual" type="text" placeholder="" readonly="true" style="cursor:default;" value=<?php if(isset($res_o[0])) {echo $res_o[2] ;}?> >
			</div>
		<label>descripcion</label>
			<div class="input-control text" data-role="input-control">
				<input id="descripcion_actual" name="descripcion_actual" type="text" placeholder="" readonly="true" style="cursor:default;" value=<?php if(isset($res_o[0])) {echo $res_o[3] ;}?> >
			</div>
		<label>precio</label>
			<div class="input-control text" data-role="input-control">
				<input id="precio_actual" name="precio_actual" type="text" placeholder="" readonly="true" style="cursor:default;" value=<?php if(isset($res_o[0])) {echo $res_o[4] ;}?> >
			</div>
		<label>tipo</label>
			<div class="input-control text" data-role="input-control">
				<input id="tipo_actual" name="tipo_actual" type="text" placeholder="" readonly="true" style="cursor:default;" value=<?php if(isset($res_o[0])) {echo $res_o[6] ;}?> >
			</div>
        <label>estado</label>
            <div class="input-control text" data-role="input-control">
                <input id="estado_actual" name="estado_actual" type="text" placeholder="" readonly="true" style="cursor:default;" value=<?php if(isset($res_o[0])) {echo $res_o[8] ;}?> >
            </div>
        <label>ubicacion actual</label>
            <div class="input-control text" data-role="input-control">
                <label><?php if(isset($res_oo[0])) {echo $res_oo[0];} ?></label>
                <input type="hidden" spellcheck="false" name="sw" id="agencia_origen" value=<?php if(isset( $res_oo[1])) {echo  $res_oo[1] ;}?> >
            </div>
    </div>
    </form>	
</div>



<div id="result_actualizar1" class="container-fluid cont" style="margin-top: -15px; width: 250px; float: right;  margin-right: 200px;">
    <form id="form3" name="form3" method="post" action="">
    <div class="row-fluid">
            <!-- boton de aceptar actualizar -->
        <div style="float: right; position: absolute; margin-left: 300px; margin-top: 160px;">
            <button class="btn btn-warning btn-large" onclick="">actualizar</button>
            <label><h6> <?php if(isset($reporte)){echo $reporte;}?> </h6></label>
        </div>
        <!-- boton de aceptar actualizar -->
            <label>serial</label>
            <div class="input-control text" data-role="input-control">
                <input id="serial_" type="text" placeholder="" readonly="true" style="cursor:default;" value=<?php if(isset($res_o[0])) {echo $res_o[1] ;}?> >
            </div>
        <label>id</label>
            <div class="input-control text" data-role="input-control">
                <input id="id_" name="id_" type="text" placeholder="" readonly="true" style="cursor:default;" value=<?php if(isset($res_o[0])) {echo $res_o[0] ;}?> >
            </div>
        <label>fabricante</label>
            <div class="input-control text" data-role="input-control">
                <input id="fabricante_actualizar" name="fabricante_actualizar" type="text" placeholder="" style="cursor:default;" value=<?php if(isset($res_o[0])) {echo $res_o[2] ;}?> >
            </div>
        <label>descripcion</label>
            <div class="input-control text" data-role="input-control">
                <input id="descripcion_actualizar" name="descripcion_actualizar" type="text" placeholder="" style="cursor:default;" value=<?php if(isset($res_o[0])) {echo $res_o[3] ;}?>  >
            </div>
        <label>precio</label>
            <div class="input-control text" data-role="input-control">
                <input id="precio_actualizar" name="precio_actualizar" type="text" placeholder="" style="cursor:default;" value=<?php if(isset($res_o[0])) {echo $res_o[4] ;}?> >
                <input type="hidden" spellcheck="false" name="agencia_origen" id="agencia_origen" value=<?php if(isset( $res_oo[1])) {echo  $res_oo[1] ;}?> >
            </div>
        <label>tipo</label>
            <div class="input-control text" data-role="input-control">
                <select id="tipo_actualizar" name="tipo_actualizar" onchange="">
                    <option value="0">seleccione</option>
                    <?php
                        while( $res_tipo = mysql_fetch_array( $sql_tipo) )
                        {
                            if( $res_tipo[0] == $res_o[5] )
                            {
                                echo "<option value='".$res_tipo[0]."' selected> ".$res_tipo[1]." </option>";
                            }
                            else
                            {
                                echo "<option value='".$res_tipo[0]."'> ".$res_tipo[1]." </option>";
                            }
                        }
                    ?>
                </select>
            </div>
        <label>estado</label>
            <div class="input-control text" data-role="input-control">
                <select id="estado_actualizar" name="estado_actualizar" onchange="">
                    <option value="0">seleccione</option>
                    <?php
                        while( $res_edo = mysql_fetch_array( $sql_edo) )
                        {
                            if($res_edo[0] == $res_o[7] )
                            {
                                echo "<option value='".$res_edo[0]."' selected> ".$res_edo[1]." </option>";
                            }
                            else
                            {
                                echo "<option value='".$res_edo[0]."'> ".$res_edo[1]." </option>";
                            }
                        }
                    ?>
                </select>
            </div>
    </div>
    </form>  
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