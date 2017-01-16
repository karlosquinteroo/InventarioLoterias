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
        $query_inventario="SELECT 
        count(m080_articulo.co_serial_articulo),
        m080_articulo.co_serial_articulo,
        p070_tipo_articulo.tx_desc_tipo_articulo,
        m080_articulo.tx_descripcion_articulo,
        m040_agencia.nb_agencia,
        m080_articulo.nu_precio,
        p060_edo_articulo.tx_desc_edo_articulo
        from 
        m080_articulo,
        p060_edo_articulo,
        p070_tipo_articulo,
        m040_agencia
        where 
        m080_articulo.co_edo_articulo = p060_edo_articulo.co_edo_articulo and
        m080_articulo.co_edo_articulo  = 2 and
        p070_tipo_articulo.co_tipo_articulo = m080_articulo.co_tipo_articulo and
        m080_articulo.ub_actual = m040_agencia.co_agencia

        group by m080_articulo.co_serial_articulo, 
        p070_tipo_articulo.tx_desc_tipo_articulo,
        m080_articulo.tx_descripcion_articulo,
        m040_agencia.nb_agencia,
        m080_articulo.nu_precio,
        p060_edo_articulo.tx_desc_edo_articulo";
        $sql_inventario= mysql_query($query_inventario);

        $sql_agencia=mysql_query("SELECT co_agencia, nb_agencia FROM `m040_agencia`; ")
        or die("problema con el query agencia"); echo mysql_error();             

        for( $j=1; $j<100; $j++ ) 
        {
            $numero[$j]=$j;
        }


        if( isset( $_POST["radiogroup"]) && isset( $_POST['cant']) &&  $_POST["agencia_asignar"] != 0 )
        {
            $serial_art=$_POST["radiogroup"];
            $cantidad_art=$_POST['cant'];
            $agencia_a=$_POST['agencia_asignar'];

            $_SESSION["array"]=$serial_art;
            $_SESSION["cantidad"]=$cantidad_art;
            $_SESSION["agencia_asignacion"]=$agencia_a;

            $user=$_SESSION['usuario'];
            $password=$_SESSION['pass'];
 
            $smax=sizeof($serial_art);
            $ssmax=sizeof($cantidad_art);

            $agregar_mov_asig=mysql_query("INSERT INTO `t050_movimiento`(`CO_movimiento`, `CO_USUARIO_MOV`, `CO_AGENCIA_MOVDEST`, `CO_AGENCIA_MOVORIG`, `CO_TIPO_MOV`) 
            VALUES ('null',(SELECT co_usuario FROM m010_usuario where NB_NOMBRE_USUARIO = '$user' AND pw_password = '$password' ),'$agencia_a',1,2);")
            or die("problema con el query movimiento "); echo mysql_error();


            $array_n = array();
            $y=0;
            for($x=0; $x<$ssmax; $x++)
            {
                if($cantidad_art[$x] != ""  )
                {
                    for($j=0; $j<$cantidad_art[$x]; $j++)
                    {
                        $serial_a=$serial_art[$y];
                        $agregar_det_mov=mysql_query("INSERT INTO `t090_detalle_movimiento`(`CO_detalle_mov`, `FE_MOV`, `CO_MOVIMIENTO`, `CO_ARTICULO`) 
                        VALUES ('null','$fecha',(SELECT CO_movimiento FROM t050_movimiento order by CO_movimiento desc limit 1),(SELECT  co_articulo FROM m080_articulo where co_serial_articulo = '$serial_a' and co_edo_articulo = 2 limit 1) )")
                        or die("problema con el query agencia"); echo mysql_error();
                        
                        $update_art=mysql_query( "UPDATE `m080_articulo` SET `CO_EDO_ARTICULO`=1, `UB_ACTUAL`= '$agencia_a' WHERE  co_serial_articulo  = '$serial_a' and ub_actual != '$agencia_a' and co_edo_articulo = 2  limit 1; ") 
                        or die("problema con el query agencia1"); echo mysql_error(); 
                    }
                    $array_n[$y]=$cantidad_art[$x];
                    echo $array_n[$y];
                    echo $_SESSION["agencia_asignacion"];
                    $y++;
                }
            }
            if(mysql_affected_rows()>0)
            {
                $query_inventario="SELECT 
                count(m080_articulo.co_serial_articulo),
                m080_articulo.co_serial_articulo,
                p070_tipo_articulo.tx_desc_tipo_articulo,
                m080_articulo.tx_descripcion_articulo,
                m040_agencia.nb_agencia,
                m080_articulo.nu_precio,
                p060_edo_articulo.tx_desc_edo_articulo
                from 
                m080_articulo,
                p060_edo_articulo,
                p070_tipo_articulo,
                m040_agencia
                where 
                m080_articulo.co_edo_articulo = p060_edo_articulo.co_edo_articulo and
                m080_articulo.co_edo_articulo  = 2 and
                p070_tipo_articulo.co_tipo_articulo = m080_articulo.co_tipo_articulo and
                m080_articulo.ub_actual = m040_agencia.co_agencia

                group by m080_articulo.co_serial_articulo, 
                p070_tipo_articulo.tx_desc_tipo_articulo,
                m080_articulo.tx_descripcion_articulo,
                m040_agencia.nb_agencia,
                m080_articulo.nu_precio,
                p060_edo_articulo.tx_desc_edo_articulo";
                $sql_inventario= mysql_query($query_inventario);
                $agencia_a ="";
                $respuesta= "Articulos Asignados Exitosamente";
                header("location:assing.php");
            }
            else
            { 
                $respuesta= "Error Al Asignar Articulos";
            }
        }
        else
        {  
        }
    ?>
</head>

<body>
<div id="header">
<?php include("header.php"); ?>
</div>

<div style="float: right; position: fixed; margin-left: 79%; margin-top: 25%;">
                    <button class="btn btn-warning large btn btn-large" onclick="recarga()">Nueva asignacion</button>
                </div>
<div style="float: right; position: fixed; margin-left: 78%; margin-top: 8%;">
<form id="form1" name="form1" method="post" action="">
    <label>agencia</label>
    <div class="input-control text" data-role="input-control">
        <select id="agencia_asignar" name="agencia_asignar" onchange="" style="width:85%;">
            <option value="0">seleccione</option>
            <?php
                while( $res_agenc = mysql_fetch_array( $sql_agencia) )
                {
                    echo "<option value='".$res_agenc[0]."'> ".$res_agenc[1]." </option>";
                }
            ?>
        </select>
    </div>
</div>
<div class="container cont cent" style="margin-top:25px;">
    <div class="well" style="margin-top: 80px;">
        <div class="container-fluid cont" style="margin-top: 5px; width: 250px;">
        <h4>Asignar articulos</h4>
            <div class="row-fluid">
                <div style="float: right; position: fixed; margin-left: 72%; margin-top: 3%;">
                    <button class="btn btn-warning large btn btn-large" onclick="">asignar</button>
                </div>
                <div id="resultado_agregar" style="float: left; position: fixed; margin-left: 71%; margin-top: 8%;"><?php if (isset( $respuesta)){ echo $respuesta;} ?></div>
            </div>
            <div style="border: 1px solid #8cbf26; width: 900px; margin-left:1%; text-align:center;">
                <table class="table" width="900" id="table" style="margin-left:0px; font-size:90%; ">
                    <tr>
                        <th align="center"> Seleccion </th>
                        <th align="center"> Disponible </th>
                        <th align="center"> Cantidad </th>                
                        <th align="center"> Serial </th>
                        <th align="center"> Tipo de articulo </th>
                        <th align="center"> Descripcion </th>
                        <th align="center"> Ubicacion </th>
                        <th align="center"> Precio </th>
                    </tr>
                    <?php while( $res_inventario = mysql_fetch_array( $sql_inventario ) ){ ?>
                    <tr>                               
                        <td align="center">
                            <div class="input-control text" data-role="input-control">
                               <?php
                                    echo "<input type='checkbox' value='".$res_inventario[1]."' name='radiogroup[]'>";                                ?>
                            </div>
                        </td>
                        <td align="center"><?php echo $res_inventario[0]; ?></td>
                        <td align="center"><?php echo "<input type='text' name='cant[]' style='width: 50px;'>"; ?></td>
                        <td align="center"><?php echo $res_inventario[1]; ?></td>
                        <td align="center"><?php echo $res_inventario[2]; ?></td>
                        <td align="center"><?php echo $res_inventario[3]; ?></td>
                        <td align="center"><?php echo $res_inventario[4]; ?></td>
                        <td align="center"><?php echo $res_inventario[5]; ?></td>
                    </tr>
                    <?php }?>
                </table>
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