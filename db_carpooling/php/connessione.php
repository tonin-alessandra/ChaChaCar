<?php

$host = "localhost";
$dbname = "carPooling";
$username = "postgres";
$password = "secchiona";
$conn = pg_connect("host = $host dbname = $dbname user= $username password=$password");
if(!$conn){
	die('Impossibile connettersi'.pg_last_error());				
}
//echo "Connessione al database ".$dbname." è andata a buon fine.</br>";

?>