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


        $codigo=$_POST["cod"];


            $query_track="
            SELECT 
                  art.co_serial_articulo,
                  art.co_articulo,
                  tipa.tx_desc_tipo_articulo,
                  agenor.nb_agencia,
                  agen.nb_agencia,
                  tipo.tx_desc_tmov
            FROM 
                  m080_articulo art,
                  p070_tipo_articulo tipa,
                  m040_agencia agen,
                  m040_agencia agenor,
                  t090_detalle_movimiento detmov,
                  t050_movimiento mov, 
                  p030_municipio muni,
                  p030_municipio munio,
                  p0140_tipo_mov tipo
            where 
                  art.co_articulo  like '%$codigo%' and
                  art.co_articulo = detmov.co_articulo and 
                  detmov.co_movimiento = mov.co_movimiento and
                  mov.co_agencia_movdest = agen.co_agencia and
                  mov.co_agencia_movorig = agenor.co_agencia and
                  tipa.co_tipo_articulo = art.co_tipo_articulo and
                  agen.co_municipio = muni.co_municipio and
                  agenor.co_municipio = munio.co_municipio and
                  mov.co_tipo_mov = tipo.co_tipo_mov
                  
            group by 
                  agen.nb_agencia,
                  agenor.nb_agencia,
                  art.co_serial_articulo,
                  art.co_articulo,
                  tipa.tx_desc_tipo_articulo,
                  tipo.tx_desc_tmov
            order by 
                  tipo.tx_desc_tmov desc;";
            $sql_track= mysql_query($query_track);
?>   
<body>

<div class="row-fluid">
                    <div style="border: 1px solid #8cbf26; width: 900px; margin-left:100px; text-align:center;">
                    <table class="table" width="900" id="table" style="margin-left:0px; ">
                            <tr>
                                <th align="center"> ID Articulo </th>
                                <th align="center"> Serial Articulo </th>               
                                <th align="center"> Tipo Articulo </th>
                                <th align="center"> Agencia Origen </th>
                                <th align="center"> Agencia Destino </th>
                                <th align="center"> Movimiento </th>
                            </tr>
                            <?php while( $res_track = mysql_fetch_array( $sql_track ) ){ ?>
                            <tr>
                                <td align="center"><?php echo $res_track[1]; ?></td>
                                <td align="center"><?php echo $res_track[0]; ?></td>
                                <td align="center"><?php echo $res_track[2]; ?></td>
                                <td align="center"><?php echo $res_track[3]; ?></td>
                                <td align="center"><?php echo $res_track[4]; ?></td>
                                <td align="center"><?php echo $res_track[5]; ?></td>
                            </tr>
                            <?php }?>
                        </table>
                        </div>


<!-- <script src="js/jquery.min.js"></script>
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
<script src="js/jquery-1.5.2.js" type="text/javascript"></script> -->

</body>

</html>