<?php
include("BD/conexion.php");//archivo de coneccion a la basede datos
require_once("miniOrm-master/miniOrm.php");//llamamos a la clase
$db = miniOrm\Db::inst();// creamos el objeto
$select="select *from notas";

?>
