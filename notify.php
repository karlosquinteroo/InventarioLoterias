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
        $user=$_SESSION['usuario'];
        $password=$_SESSION['pass'];
        if( !isset( $_SESSION["autenticado"] ) )
        {
            header("location:index.php");
        }

        $fecha=date("y/m/d");
        include("conex.php"); 
        $linbd=conectar(); 
        $fecha1=date("m");
        $query_inventario="SELECT  
                            art.co_serial_articulo,
                            art.nb_fabricante,
                            det.nu_precio_plan,
                            m040_agencia.nb_agencia,
                            det.fe_plan
                        from
                            m080_articulo art,
                            p060_edo_articulo edo,
                            p070_tipo_articulo tipo,
                            t0150_detalle_articulo det, 
                            m040_agencia
                        where 
                            art.co_articulo != 6 and 
                            art.co_tipo_articulo = 9 and
                            edo.co_edo_articulo = art.co_edo_articulo and
                            tipo.co_tipo_articulo = art.co_tipo_articulo and
                            det.co_articulo = art.co_articulo and
                            art.ub_actual =  m040_agencia.co_agencia ";
        $sql_inventario= mysql_query($query_inventario); 
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
                    <h4>inventario de articulos</h4>
                    <div id="resultado_e"><h4></h4></div>
                <div class="row-fluid">
                    <div style="border: 1px solid #8cbf26; width: 400%; margin-left:15%; text-align:center;">
                    <table class="table" id="table" style="margin-left:0%; width:500%; font-size:90%; ">
                        <tr>
                            <th align="center"> Serial </th>
                            <th align="center"> Operador </th>               
                            <th align="center"> Costo plan </th>
                            <th align="center"> Ubicacion </th>
                            <th align="center"> Fecha de pago </th>
                            <th align="center"> Proximo dia de pago </th>
                            <!-- <th align="center"> estado </th> -->
                        </tr>
                        <?php while( $res_inventario = mysql_fetch_array( $sql_inventario ) ){  ?>
                        <tr>
                            <td align="center"><?php echo $res_inventario[0]; ?></td>
                            <td align="center"><?php echo $res_inventario[1]; ?></td>
                            <td align="center"><?php echo $res_inventario[2]; ?></td>
                            <td align="center"><?php echo $res_inventario[3]; ?></td>
                            <td align="center"><?php echo $res_inventario[4]; ?></td>
                            <?php  $fecha_p = date('Y-m-d', strtotime("$res_inventario[4]+1 month"));?>
                            <td align="center"><?php echo $fecha_p; ?></td>
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