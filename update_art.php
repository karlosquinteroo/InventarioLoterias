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
        $agencia_origen=$_POST["localizacion"];
        $estado=$_POST["id"];
        $id=$_POST["art"];


        $agregar_mov=mysql_query("INSERT INTO `t050_movimiento`(`CO_movimiento`,`CO_USUARIO_MOV`,`CO_AGENCIA_MOVDEST`,`CO_AGENCIA_MOVORIG`,`CO_TIPO_MOV`) 
        values('null',(SELECT co_usuario FROM m010_usuario where NB_NOMBRE_USUARIO = '$user' AND pw_password = '$password' ),1,'$agencia_origen',14);") 
        or die("problema con el query movimiento"); echo mysql_error();;

        $agregar_det_mov=mysql_query("INSERT INTO `t090_detalle_movimiento` (`CO_detalle_mov`,`FE_MOV`,`CO_MOVIMIENTO`,`CO_ARTICULO`)
        values('null', '$fecha',(SELECT CO_movimiento FROM t050_movimiento order by CO_movimiento desc limit 1),'$id' );");

        $actualizar_articulo=mysql_query("UPDATE `m080_articulo` SET `CO_EDO_ARTICULO`='$estado', `UB_ACTUAL`=1 WHERE co_articulo='$id' ")
         or die("problema con el queryactualizar"); echo mysql_error();
        
        if(mysql_affected_rows()>0)
        {
            $reporte="Articulo actualizado exitosamente";   
        }
    ?>