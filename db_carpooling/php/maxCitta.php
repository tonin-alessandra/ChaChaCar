<?php

	require_once("testa.php");
	require_once("lib_utenti_db.php");
	
	$elenco_campi = array("Nome" => 0, "Nazione" =>1);
	$elenco_alias = array("Città" => 0, "Nazione" => 1);
	$sql = maxCitta($elenco_campi);
    $tabella = tabella($sql, $elenco_alias);
    echo $tabella;

	require_once("coda.php");
	
?>