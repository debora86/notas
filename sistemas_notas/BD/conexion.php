<?php
//conectarse a una base de datos llamada "notas" en el host "sheep" con el nombre de usuario y password
$conn_string = "host	=localhost 
				port	=5432 
				dbname	=notas 
				user	=postgres
				password=1
			   ";
$dbconn4 = pg_connect($conn_string)or die("Error. No se pudo conectar. Verifique sus datos");

?>
