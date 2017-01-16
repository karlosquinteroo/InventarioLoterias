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
<script type="text/javascript" src="js/jqueryui.js"></script> -->

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
		include("conex.php");
		$linbd=conectar();


 $nombreprov=ucwords($nombreprov=$_POST['nombreprov']);
 $provexist=$_POST['provexist'];
 $direcprov=ucwords($direcprov=$_POST['direcprov']);
 $telefprov=$_POST['telefprov'];
 $rifprov=$_POST['rifprov'];
 $muniprov=$_POST['muniprov'];
 $tipo_ingreso=$_POST['tipo_ingreso'];

 $serial=strtoupper($serial=$_POST['serial']);
 $descripcion=ucwords($descripcion=$_POST['descripcion']);
 $precio=$_POST['precio'];
 $deposito=$_POST['deposito'];
 $cantidad=$_POST['cantidad'];
 $tipo_articulo=$_POST['tipo_articulo'];
 $costo_plan=$_POST['costo_plan'];
 $fecha_plan=$_POST['fecha_plan'];
 $detarti=ucwords($detarti=$_POST['detarti']);
 $fabricante=ucwords($fabricante=$_POST['fabricante']);
 $user=$_SESSION['usuario'];
 $password=$_SESSION['pass'];
 $fecha=date("y/m/d");



$comprobar="SELECT * FROM m080_articulo where co_serial_articulo = '$serial'";
$resultado = mysql_query($comprobar);

if( mysql_fetch_array( $resultado ) == 0 )
{
    $agregar_mov2=mysql_query
    ("INSERT INTO `t050_movimiento` 
      (`CO_movimiento`, `CO_USUARIO_MOV`, `CO_AGENCIA_MOVDEST`, `CO_AGENCIA_MOVORIG`, `CO_TIPO_MOV`) 
      VALUES
       ('null',(SELECT co_usuario FROM m010_usuario where NB_NOMBRE_USUARIO = '$user' AND pw_password = '$password'),'$deposito','$deposito',1);
    ") 
     or die("problema con el query");
     echo mysql_error();

    if( $provexist == 0 )
    {
        if($tipo_ingreso == 1)
        {
            $agregar_proveedor=mysql_query
            ("INSERT INTO `m0100_proveedor`(`CO_PROVEEDOR`, `NB_NOMBRE_PROVEEDOR`, `TX_DIRECCION_PROV`, `NU_TELEFONO_PROV`, `NU_RIF_PROV`, `CO_MUNICIPIO`)
             VALUES ('null','$nombreprov','$direcprov','$telefprov','$rifprov','muniprov')")
             or die("problema con el query1"); echo mysql_error();

            $agregar_ingreso=mysql_query
            ("INSERT INTO `t0120_ingreso`(`CO_ingreso`, `TX_DESC_INGRESO`, `CO_TIPO_INGRESO`, `CO_PROVEEDOR`, `FE_ENTRADA`)
              VALUES('null','Compra De Equipos','$tipo_ingreso',(SELECT co_proveedor FROM `m0100_proveedor` order by co_proveedor desc limit 1),'$fecha') 
              ") or die("problema con el query2"); echo mysql_error();
            $tx_desc='Compra A Proveedor';
        }
        else
        {
            $agregar_proveedor=mysql_query
            ("INSERT INTO `m0100_proveedor`(`CO_PROVEEDOR`, `NB_NOMBRE_PROVEEDOR`, `TX_DIRECCION_PROV`, `NU_TELEFONO_PROV`, `NU_RIF_PROV`, `CO_MUNICIPIO`)
             VALUES ('null','$nombreprov','$direcprov','$telefprov','$rifprov','muniprov')")
             or die("problema con el query3"); echo mysql_error();

            $agregar_ingreso=mysql_query
            ("INSERT INTO `t0120_ingreso`(`CO_ingreso`, `TX_DESC_INGRESO`, `CO_TIPO_INGRESO`, `CO_PROVEEDOR`, `FE_ENTRADA`)
              VALUES('null','Donacion','$tipo_ingreso',(SELECT co_proveedor FROM `m0100_proveedor` order by co_proveedor desc limit 1),'$fecha') 
              ") or die("problema con el query4"); echo mysql_error();
            $tx_desc='Donacion';
        }
    }
    else
    {
        if($tipo_ingreso == 1)
        {
            $agregar_ingreso=mysql_query
            ("INSERT INTO `t0120_ingreso`(`CO_ingreso`, `TX_DESC_INGRESO`, `CO_TIPO_INGRESO`, `CO_PROVEEDOR`, `FE_ENTRADA`)
              VALUES('null','Compra De Equipos','$tipo_ingreso','$provexist','$fecha') 
              ") or die("problema con el query5"); echo mysql_error();
            $tx_desc='Compra A Proveedor';
             
        }
        else
        {
            $agregar_ingreso=mysql_query
            ("INSERT INTO `t0120_ingreso`(`CO_ingreso`, `TX_DESC_INGRESO`, `CO_TIPO_INGRESO`, `CO_PROVEEDOR`, `FE_ENTRADA`)
              VALUES('null','Donacion','$tipo_ingreso','$provexist','$fecha') 
              ") or die("problema con el query5"); echo mysql_error();
            
            $tx_desc='Donacion'; 
        }
    }
    if($tipo_articulo == 21 )
    {
        $agregar_tipo_art=mysql_query("INSERT INTO `p070_tipo_articulo`(`CO_tipo_articulo`, `TX_DESC_TIPO_ARTICULO`) VALUES ('null','$detarti')")
         or die("problema con el query7"); echo mysql_error();
    }
    for($i=0; $i<$cantidad; $i++)
    {
        if($tipo_articulo != 9 && $tipo_articulo != 21 )
        {
           $agregar_art=mysql_query("INSERT INTO `m080_articulo`(`CO_articulo`, `CO_SERIAL_ARTICULO`, `NB_FABRICANTE`, `TX_DESCRIPCION_ARTICULO`, `NU_PRECIO`, `CO_EDO_ARTICULO`, `CO_TIPO_ARTICULO`, `UB_ACTUAL`) 
            VALUES ('null','$serial','$fabricante','$descripcion','$precio',2,'$tipo_articulo','$deposito')")
            or die("problema con el query8"); echo mysql_error();
        }
        if($tipo_articulo == 9 )
        {
          $agregar_art=mysql_query("INSERT INTO `m080_articulo`(`CO_articulo`, `CO_SERIAL_ARTICULO`, `NB_FABRICANTE`, `TX_DESCRIPCION_ARTICULO`, `NU_PRECIO`, `CO_EDO_ARTICULO`, `CO_TIPO_ARTICULO`, `UB_ACTUAL`) 
          VALUES ('null','$serial','$fabricante','$descripcion','$precio',2,'$tipo_articulo','$deposito')")
          or die("problema con el query9"); echo mysql_error();
           
          $agregar_det_art=mysql_query(" INSERT INTO `t0150_detalle_articulo`(`CO_DETALLE_ARTICULO`, `FE_PLAN`, `NU_PRECIO_PLAN`, `CO_ARTICULO`)
          VALUES ('null','$fecha_plan','$costo_plan', (SELECT CO_ARTICULO FROM m080_articulo order by CO_ARTICULO desc limit 1) ) ")
          or die("problema con el query10");
        }
        if($tipo_articulo == 21 )
        {
           $agregar_art=mysql_query
           ("INSERT INTO `m080_articulo`(`CO_articulo`, `CO_SERIAL_ARTICULO`, `NB_FABRICANTE`, `TX_DESCRIPCION_ARTICULO`, `NU_PRECIO`, `CO_EDO_ARTICULO`, `CO_TIPO_ARTICULO`, `UB_ACTUAL`) 
            VALUES ('null','$serial','$fabricante','$descripcion','$precio',2,(SELECT co_tipo_articulo FROM `p070_tipo_articulo` order by co_tipo_articulo desc limit 1),'$deposito')") 
            or die("problema con el query11"); echo mysql_error();
        }

        $agregar_de_ingreso=mysql_query
        ("INSERT INTO `t0130_detalle_de_ingreso`(`CO_detalle_ingreso`, `TX_DESC_DET_INGRE`, `CO_INGRESO`, `CO_ARTICULO`) VALUES ('null','$tx_desc',(SELECT co_ingreso FROM t0120_ingreso order by co_ingreso desc limit 1),(SELECT CO_ARTICULO FROM m080_articulo order by CO_ARTICULO desc limit 1))")
        or die("problema con el query12"); echo mysql_error();

        $agregar_det_mov=mysql_query
        ("INSERT INTO `t090_detalle_movimiento`(`CO_detalle_mov`, `FE_MOV`, `CO_MOVIMIENTO`, `CO_ARTICULO`) VALUES ('null','$fecha',(SELECT CO_movimiento FROM t050_movimiento order by CO_movimiento desc limit 1),(SELECT CO_ARTICULO FROM m080_articulo order by CO_ARTICULO desc limit 1) )")  
        or die("problema con el query13"); echo mysql_error();
    }
    if(mysql_affected_rows()>0)
    {
        echo "Articulo Agregado Exitosamente";  
    }
    else
    { 
        echo "Error Al Agregar Nuevo Articulo";
    }
}
else
{
    echo "Error Serial de Articulo ya Registrado";
}

?>