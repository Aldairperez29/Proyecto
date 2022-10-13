<?php
/* Esta ejecutando MySQL
servidor con configuración predeterminada (usuario 'root' sin contraseña) */
define('DB_SERVER', 'bbgivvfhkfscmaoe0lb1-mysql.services.clever-cloud.com');
define('DB_USERNAME', 'u4qxkyflh54inowv');
define('DB_PASSWORD', 'bVY7VzUkEOK2etcRRxI9');
define('DB_NAME', 'bbgivvfhkfscmaoe0lb1');
 
/* Intento de conexión a la base de datos MySQL */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Verifica la conexión
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>