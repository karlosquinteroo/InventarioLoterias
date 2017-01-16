<?php 
session_start();
include("conex.php");
$linbd=conectar();

$_POST['nb'];

	if( $_POST['sw'] == 0 )
	{
		if ($_POST['nb']=='admin'|| $_POST["pw"]=='admin' )
		{
			header("location:index.php");
		}
		else
		{
			$conraseña= $_POST["pw"] ;
			$equery="SELECT * FROM m010_usuario where NB_NOMBRE_USUARIO = '{$_POST["nb"]}' AND pw_password = '$conraseña' ";
			$res=mysql_query($equery) or die( mysql_error() );
			
			if( mysql_num_rows($res) == 1 )
			{
				$query_ad="select * from m010_usuario where NB_NOMBRE_USUARIO='{$_POST["nb"]}' and co_prioridad='1' ";
	   			$resp=mysql_query($query_ad);
	  			$q_ad=mysql_num_rows($resp);
				
				if( $q_ad <= 0)
				{
				 	$query="select co_usuario from m010_usuario where NB_NOMBRE_USUARIO= '".$_POST['nb']."'";
					$campos=mysql_fetch_array( mysql_query($query) ) ;
					$_SESSION["autenticado"]= "SI";
					$_SESSION['co_usuario']=$campos[0];
					$_SESSION['usuario']=$_POST['nb'];
					$_SESSION['pass']=$_POST['pw'];
					session_write_close();	
					header("location:menu.php");
					
		 		}
	     		else
				{
					$query="select co_usuario from m010_usuario where NB_NOMBRE_USUARIO= '".$_POST['nb']."'";
					$campos=mysql_fetch_array( mysql_query($query) ) ;
					$_SESSION["autenticado"]= "SI";
					$_SESSION['co_usuario']=$campos[0];
					$_SESSION['usuario']=$_POST['nb'];
					$_SESSION['pass']=$_POST['pw'];
					session_write_close();
					header("location:menu.php");
				 }
			}
			else
			{
				header("location:index.php");
			}
		}
	}//sw == 0 ingreso usuarios registrados
	
	
	

?>


