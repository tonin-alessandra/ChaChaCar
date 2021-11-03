<?php
	require_once("testa.php");
	session_destroy();
	header("Location: index.php?msg=Grazie per aver utilizzato i nostri servizi! Au revoir!");
	require_once("coda.php");
?>
