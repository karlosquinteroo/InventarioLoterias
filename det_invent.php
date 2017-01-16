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
     window.onload=baja;
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

        $query_inventario_det="SELECT 
        m080_articulo.co_articulo,
        m080_articulo.co_serial_articulo,
        p070_tipo_articulo.tx_desc_tipo_articulo,
        m080_articulo.tx_descripcion_articulo,
        m040_agencia.nb_agencia,
        m080_articulo.nu_precio,
        p060_edo_articulo.tx_desc_edo_articulo,
        m0100_proveedor.nb_nombre_proveedor
        from m080_articulo, p060_edo_articulo, p070_tipo_articulo, m040_agencia, t0130_detalle_de_ingreso, t0120_ingreso, m0100_proveedor
        where p060_edo_articulo.co_edo_articulo = m080_articulo.co_edo_articulo and
        p070_tipo_articulo.co_tipo_articulo = m080_articulo.co_tipo_articulo and
        m080_articulo.ub_actual = m040_agencia.co_agencia and
        m080_articulo.co_articulo = t0130_detalle_de_ingreso.co_articulo and 
        t0130_detalle_de_ingreso.co_ingreso = t0120_ingreso.co_ingreso and
        t0120_ingreso.co_proveedor = m0100_proveedor.co_proveedor
        order by p070_tipo_articulo.tx_desc_tipo_articulo;";
        $sql_inventario_det= mysql_query($query_inventario_det); 
            
?>

</head>
<body>

<div id="header">
<?php include("header.php"); ?>
</div>


<!-- add article -->
    <div class="container cont cent" style="margin-top:25px;">
        <div class="well" style="margin-top: 80px;">
            <div class="container-fluid cont" style="margin-top: 5px; width: 250px;">
                    <h4>inventario detallado</h4>
                <div class="row-fluid">
                    <div style="border: 1px solid #8cbf26; width: 900px; margin-left:100px; text-align:center;">
                    <table class="table" width="900" id="table" style="margin-left:0px; font-size:90%; ">
                        <tr>
                            <th align="center"> codigo </th>
                            <th align="center"> Serial Articulo </th>               
                            <th align="center"> Tipo Articulo </th>
                            <th align="center"> Descripcion </th>
                            <th align="center"> Ubicacion </th>
                            <th align="center"> Precio </th>
                            <th align="center"> Estatus </th>
                            <th align="center"> proveedor </th>
                        </tr>
                        <?php while( $res_inventario_d = mysql_fetch_array( $sql_inventario_det ) ){  ?>
                        <tr>
                            <td align="center"><?php echo $res_inventario_d[0]; ?></td>
                            <td align="center"><?php echo $res_inventario_d[1]; ?></td>
                            <td align="center"><?php echo $res_inventario_d[2]; ?></td>
                            <td align="center"><?php echo $res_inventario_d[3]; ?></td>
                            <td align="center"><?php echo $res_inventario_d[4]; ?></td>
                            <td align="center"><?php echo $res_inventario_d[5]; ?></td>
                            <td align="center"><?php echo $res_inventario_d[6]; ?></td>
                            <td align="center"><?php echo $res_inventario_d[7]; ?></td>
                        </tr>
                        <?php }?>
                    </table>
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