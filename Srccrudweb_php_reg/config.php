<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', '31_reguser');
 
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);                 /* Attempt to connect to MySQL database */

if($mysqli === false){                                                              // Check connection
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>