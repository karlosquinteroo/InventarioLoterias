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
<script></script>

<?php 
ob_start(); 
session_start();
include("conex.php");
$linbd=conectar();


$user=$_SESSION['usuario'];
$password=$_SESSION['pass'];

?>

<form id="form1" name="form1" method="post" action="">
</form>
<div class="container cont cent" style="margin-top:0px;">
<div class="well" style="margin-top: 8px;">
<span class="justificado">
<h3 class="brand">Apuestas La Seguridad</h3>
<p><h4>inventario de articulos</h4></p>
</span>
</div>
</div>
<?php  
$query_inventario="SELECT 
                 count(m080_articulo.co_serial_articulo),
                 m080_articulo.co_serial_articulo,
                 p070_tipo_articulo.tx_desc_tipo_articulo,
                 m080_articulo.tx_descripcion_articulo,
                 m040_agencia.nb_agencia,
                 m080_articulo.nu_precio,
                 p060_edo_articulo.tx_desc_edo_articulo
        from m080_articulo, p060_edo_articulo, p070_tipo_articulo, m040_agencia
        where p060_edo_articulo.co_edo_articulo = m080_articulo.co_edo_articulo and
        p070_tipo_articulo.co_tipo_articulo = m080_articulo.co_tipo_articulo and
        m080_articulo.ub_actual = m040_agencia.co_agencia
        group by m080_articulo.co_serial_articulo ";
$sql_inventario= mysql_query($query_inventario); 
?>
             
<!-- add article -->
    <div class="container cont cent" style="margin-top:5px;">
        <div class="well" style="margin-top: 80px;">
            <div class="container-fluid cont" style="margin-top: 1px; width: 250px;">
                <div class="row-fluid">
                    <div style="border: 1px solid #8cbf26; width: 720px; text-align:center; ">
                    <table class="table"  width="520" id="table" style="margin-left:0px; font-size:80%;">
                        <tr>
                            <th align="center"> Cantidad </th>
                            <th align="center"> Serial Articulo </th>               
                            <th align="center"> Tipo Articulo </th>
                            <th align="center"> Descripcion </th>
                            <th align="center"> Ubicacion </th>
                            <th align="center"> Precio </th>
                            <th align="center"> Estatus </th>
                        </tr>
                        <?php while( $res_inventario = mysql_fetch_array( $sql_inventario ) ){  ?>
                        <tr>
                            <td align="center"><?php echo $res_inventario[0]; ?></td>
                            <td align="center"><?php echo $res_inventario[1]; ?></td>
                            <td align="center"><?php echo $res_inventario[2]; ?></td>
                            <td align="center"><?php echo $res_inventario[3]; ?></td>
                            <td align="center"><?php echo $res_inventario[4]; ?></td>
                            <td align="center"><?php echo $res_inventario[5]; ?></td>
                            <td align="center"><?php echo $res_inventario[6]; ?></td>
                        </tr>
                        <?php }?>
                    </table>
                    </div>
                </div>  
            </div>   
        </div>
    </div>
<!-- add provee -->
</head>
<body>
<?php
        $nombre;
        require_once("dompdf/dompdf_config.inc.php");
        $dompdf = new DOMPDF();
        $pag = 'assing.php';
        $dompdf->load_html(ob_get_clean());
        $dompdf->render();
        $pdf = $dompdf->output(); 
        $filename = $nombre.$fecha.'.pdf';
        file_put_contents("Reporte/$filename", $pdf);
        $dompdf->stream($filename);
?>


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
<script src="js/jquery-1.5.2.js" type="text/javascript"></script>

</body>

</html>