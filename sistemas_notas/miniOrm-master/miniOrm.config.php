<?php
//aqui el miniorm.config.php es el que tiene la conexion

### Required fields

define('_MO_DB_NAME_', 'notas');
define('_MO_DB_LOGIN_', 'postgres');
define('_MO_DB_MDP_', '1');
define('_MO_DB_SERVER_', 'localhost');

### Optional fields

define('_MO_CACHE_DIR_', '/cache/');//este es para manejar el directorio de cache es una carpeta que guarda archivos temporales
define('_MO_CLASS_DIR_', '/class/');//y esta es el directorio que tiene las calses y se ponen ambas como constantes
//define te pone una variable o cualquier cos como una constante osea una variable que no cambia en este caso un directorio
//por eso usa _DIR_ eso te muestra el directorio actual_DIR_, /directorio el que sea le dice que balla para ese directorio
//porque van a usar esta conexion a la BD si?si en  pocas palabra esto tiene la conexion y de aqui se conectan los demas o los demas usan esta conexion

# Display MySQL error
define('_MO_DEBUG_', true);//para el manejo de excepciones o errores de la clase
//l pone en verdad para que nos mande los errores en caso de que nos equivoquemos haciendo las sentencias ya sea una coma o una comilla etc o el orden en que hiciste la sentencia esta mal
//este te permite mandar el error y te dice mas o menos que paso

# Freeze option permitt to add to cache your database configuration.
# Once activated, you can't access to new table dynamically : just active it in production.
define('_MO_FREEZE_', false);//este cuando ya el sofware esta en produccion osea cuando se sube o se aloja en un servidor
//se pone en false mientras se esta en desarrollo por que usamos un servidor local cuando se valla a subir al servido se pone en true
//si? ok
?>
