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
            $query_inventario="SELECT 
                                    distinct t050_movimiento.co_movimiento,
                                    p0140_tipo_mov.tx_desc_tmov,
                                    concat ( m010_usuario.nb_pnombre, concat (' ', m010_usuario.nb_papellido) ),
                                    m040_agencia.nb_agencia, x.nb_agencia  
                                from  
                                    t050_movimiento,
                                    m010_usuario,
                                    m040_agencia,
                                    m040_agencia x,
                                    p0140_tipo_mov,
                                    m040_agencia u
                                where 
                                    t050_movimiento.co_agencia_movdest = m040_agencia.co_agencia and
                                    t050_movimiento.co_agencia_movorig = x.co_agencia and 
                                    t050_movimiento.co_tipo_mov = p0140_tipo_mov.co_tipo_mov and 
                                    t050_movimiento.co_usuario_mov = m010_usuario.co_usuario";
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
                    <h4>Historial de movimientos</h4>
                <div class="row-fluid">
                    <div style="border: 1px solid #8cbf26; width: 900px; margin-left:100px; text-align:center;">
                    <table class="table" width="900" id="table" style="margin-left:0px; ">
                        <tr>
                            <th align="center"> Codigo movimiento </th>
                            <th align="center"> Tipo de movimiento </th>               
                            <th align="center"> Usuario responsable </th>
                            <th align="center"> Agencia de origen </th>
                            <th align="center"> Agencia destino </th>
                        </tr>
                        <?php while( $res_inventario = mysql_fetch_array( $sql_inventario ) ){  ?>
                        <tr>
                            <td align="center"><?php echo $res_inventario[0]; ?></td>
                            <td align="center"><?php echo $res_inventario[1]; ?></td>
                            <td align="center"><?php echo $res_inventario[2]; ?></td>
                            <td align="center"><?php echo $res_inventario[4]; ?></td>
                            <td align="center"><?php echo $res_inventario[3]; ?></td>
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