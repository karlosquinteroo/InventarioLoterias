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
            $query_inventario=" select
                                  m040_agencia.co_agencia,
                                  m040_agencia.nb_agencia,
                                  m040_agencia.nu_rif,
                                  m040_agencia.nu_telefono,
                                  m040_agencia.nb_encargado,
                                  m040_agencia.tx_direccion,
                                  p030_municipio.nb_ciudad,
                                  p030_municipio.nb_municipio,
                                  m020_estado.nb_estado
                                from 
                                    m040_agencia,
                                    m020_estado,
                                    p030_municipio
                                where 
                                    m040_agencia.co_municipio = p030_municipio.co_municipio and
                                    p030_municipio.co_estado = m020_estado.co_estado
                                order by m040_agencia.co_agencia";
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
                <div class="row-fluid">
                    <div style="border: 1px solid #8cbf26; width: 400%; margin-left:15%; text-align:center;">
                    <table class="table" id="table" style="margin-left:0%; width:500%; font-size:90%; ">
                        <tr>
                            <th align="center"> codigo </th>
                            <th align="center"> nombre </th>               
                            <th align="center"> rif </th>
                            <th align="center"> telefono </th>
                            <th align="center"> encargado </th>
                            <th align="center"> direccion </th>
                            <th align="center"> ciudad </th>
                            <th align="center"> municipio </th>
                            <th align="center"> estado </th>
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
                            <td align="center"><?php echo $res_inventario[7]; ?></td>
                            <td align="center"><?php echo $res_inventario[8]; ?></td>
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