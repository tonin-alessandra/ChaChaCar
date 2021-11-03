<?php

	require_once("testa.php");
	require_once("lib_utenti_db.php");
	
	$elenco_campi = array("C1.Nome" => 0, "C2.Nome" => 1);
	$elenco_alias = array("Partenza" => 0, "Destinazione" => 1);
	$sql = maxTratta($elenco_campi);
    $tabella = tabella($sql, $elenco_alias);
    echo $tabella;

	require_once("coda.php");
	
?>