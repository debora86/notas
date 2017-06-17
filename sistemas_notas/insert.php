<?php
include("BD/conexion.php");//archivo de coneccion a la basede datos
require_once("miniOrm-master/miniOrm.php");//llamamos a la clase
$db = miniOrm\Db::inst();// creamos el objeto

$det_nota=$_POST['det_nota'];
$bool_eliminado='false';

 $insertar= array('det_nota' => $det_nota, 
		'bool_eliminado' => $bool_eliminado,
		'fecha_crea' => date("Y-m-d"),);
		$registro = $db->insert('notas', $insertar);

echo "<script>window.location.replace('index.php');</script>";

?>
