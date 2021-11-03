<?php

	require_once("testa.php");
	require_once("lib_utenti_db.php");
	
	$elenco_campi = array("Modello" => 0, "CasaAutomobilistica" => 1, "NumPosti" => 2);
	$elenco_alias = array("Modello" => 0, "Casa Automobilistica" => 1, "Numero Posti" => 2);
	$sql = maxModello($elenco_campi);
    $tabella = tabella($sql, $elenco_alias);
    echo $tabella;

	require_once("coda.php");
	
?>