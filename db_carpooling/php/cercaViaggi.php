<?php

	require_once("testa.php");
	require_once("lib_utenti_db.php");
	
	$elenco_campi = array("V.Autista" => 0, "DataOraPartenza" => 1, "Note" => 2, "CostoTotale/(NumPosti -PostiDisponibili + 1)" => 3);
	$elenco_alias = array("Autista" => 0, "Partenza" => 1, "Note" => 2, "Costo in euro" => 3);
	if(!empty($_POST)){
		$cittaP = $_POST['cittaA'];
		$cittaA = $_POST['cittaP'];
	}	
	$sql = cercaViaggi($elenco_campi, $cittaP, $cittaA);
    $tabella = tabella($sql, $elenco_alias);
    echo $tabella;
	
	require_once("coda.php");
?>		