<?php

	require_once("testa.php");
	require_once("lib_utenti_db.php");
	
	$elenco_campi = array("Nome" => 0, "Cognome" => 1, "NumPatente" => 2);
	$elenco_alias = array("Nome" => 0, "Cognome" => 1, "Numero Patente" => 2);
	$sql = passeggeriAutisti($elenco_campi);
    $tabella = tabella($sql, $elenco_alias);
    echo $tabella;

	require_once("coda.php");
	
?>