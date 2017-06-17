<?php
include("BD/conexion.php");//archivo de coneccion a la basede datos
require_once("miniOrm-master/miniOrm.php");//llamamos a la clase
$db = miniOrm\Db::inst();// creamos el objeto



$cod=$_GET['cod'];
$cod=$_GET['cod'];

$eliminar_nota=$db->UPDATE('notas', array("cod_nota='$cod'"));
if($eliminar_nota > 0){		
		echo "<script>alert('Error al Eliminar');window.location.replace('index.php');</script>";
		}
		else{
		echo "<script>window.location.replace('index.php');</script>";
		}

?>
