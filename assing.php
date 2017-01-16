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
$_SESSION["array"];
$_SESSION["cantidad"];
$_SESSION["agencia_asignacion"];
$fecha=date("y/m/d");



$nuevo_array_cantidad =$_SESSION["cantidad"];
$smax_c=sizeof($nuevo_array_cantidad);
$array_nuevo = array();
$plus=0;
for($y=0; $y<$smax_c; $y++)
{
    if( $nuevo_array_cantidad[$y] == "")
    {}
    else
    {
        $array_nuevo[$plus]=$nuevo_array_cantidad[$y];
        $plus++;
    }
}

$smax=sizeof($_SESSION["array"]);
?>

<form id="form1" name="form1" method="post" action="">
<div style="float: right; position: fixed; margin-left: 92%; margin-top: 1%;">
<input type="hidden" spellcheck="false" id="flag" name="flag" placeholder="Nombre Proveedor">
</div>
</form>
<div class="container cont cent" style="margin-top:25px;">
<div class="well" style="margin-top: 80px;">
<span class="justificado">
<h3 class="brand">Apuestas La Seguridad</h3>
<p style="text-align: center;">RECIBO</p>
<div style="text-align:justify;">
Yo, ________________________________________ V() E(), de Documento de indentidad Nro:_______________, Hago Constar mediante la presente que he recibido de parte de "Apuestas La Seguridad", en calidad de prestamo y optimas condiciones de funcionamiento, los siguietntes equipos:</br>
</div>
</span>
</div>
</div>
<p>
<p>
<?php 
$agencia=$_SESSION["agencia_asignacion"]; 
for($x=0; $x<$smax; $x++)
{
        $valor=$_SESSION["array"][$x];
        

        $query_factura="SELECT p070_tipo_articulo.tx_desc_tipo_articulo, m080_articulo.nb_fabricante, m080_articulo.nu_precio, m080_articulo.tx_descripcion_articulo 
                from  m080_articulo,  p070_tipo_articulo
                where p070_tipo_articulo.co_tipo_articulo = m080_articulo.co_tipo_articulo and
                m080_articulo.co_serial_articulo = '$valor' limit 1";
        $sql_factura= mysql_query($query_factura);

        $query_agencia_f="SELECT nb_agencia FROM `m040_agencia` WHERE co_agencia = '$agencia'";
        $sql_factura_f= mysql_query($query_agencia_f);
?>
             <div style="border: 1px solid #8cbf26; width: 720px; text-align:center; ">
                    <table class="table"  width="520" id="table" style="margin-left:0px; font-size:80%;">
                            <tr>
                                <th align="center"> Tipo Articulo </th>
                                <th align="center"> Fabricante </th>               
                                <th align="center"> Precio </th>
                                <th align="center"> Descripcion </th>
                                <th align="center"> Cantidad </th>
                                <th align="center"> Agencia </th>
                            </tr>
                            <?php while( $res_inventario = mysql_fetch_array( $sql_factura ) ){  ?>
                            <tr>
                                <td align="center"><?php echo $res_inventario[0]; ?></td>
                                <td align="center"><?php echo $res_inventario[1]; ?></td>
                                <td align="center"><?php echo $res_inventario[2]; ?></td>
                                <td align="center"><?php echo $res_inventario[3]; ?></td>
                                <td align="center"><?php echo $array_nuevo[$x]; ?></td>
                        <?php while( $res_inventario_f = mysql_fetch_array( $sql_factura_f ) ){  ?>
                                <td align="center"><?php echo $res_inventario_f[0]; $nombre=$res_inventario_f[0]; ?></td>
                                 <?php } ?>
                            </tr>
                            <?php } ?>
                        </table>
                </div>
<?php
}?>
<div class="container cont cent" style="margin-top:1%;">
<div class="well" style="margin-top: 80px; ">
<span class="justificado" style="text-align: justify;" >
<p><br>
</p>
<p style="text-align: center;">______________________________</p>
<p style="text-align: center;">        Firma Recibido </p>    
<p style="text-align: center;"> Fecha De Reporte <?php echo $fecha=date("d/m/Y"); ?></p>
</span>
</div>
</div>
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