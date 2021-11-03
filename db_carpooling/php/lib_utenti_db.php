<?php
function connetti() 
{
	$conn = NULL;
	require_once("connessione.php");
	return $conn;
}

function passeggeriSenzaPrenotazioni($elenco_campi){
	$elenco_campi_select = "";
	foreach($elenco_campi as $nome_campo => $indice_campo) {
	  $elenco_campi_select .= ", ".$nome_campo;
	}
	return 	"SELECT ".ltrim($elenco_campi_select, ",")." FROM Passeggero AS P WHERE NOT EXISTS ( SELECT * FROM Prenotazione WHERE Passeggero = P.CF ) ORDER BY Cognome, Nome;";
}

function maxTratta ($elenco_campi){
	$elenco_campi_select = "";
	foreach($elenco_campi as $nome_campo => $indice_campo) {
	  $elenco_campi_select .= ", ".$nome_campo;
	}
	return "SELECT ".ltrim($elenco_campi_select, ",")." FROM Viaggio AS V JOIN Citta AS C1 ON V. CittaP = C1.CodCitta JOIN Citta AS C2 ON CittaA = C2.CodCitta GROUP BY C1.Nome, C2.Nome ORDER BY COUNT(*) DESC LIMIT 5;";
}

function passeggeriAutisti($elenco_campi){
	$elenco_campi_select = "";
	foreach($elenco_campi as $nome_campo => $indice_campo) {
	  $elenco_campi_select .= ", ".$nome_campo;
	}
	return "SELECT ".ltrim($elenco_campi_select, ",")." FROM Autista RIGHT JOIN Passeggero ON Passeggero = CF ORDER BY Cognome, Nome;";
}

function maxModello($elenco_campi){
	$elenco_campi_select = "";
	foreach($elenco_campi as $nome_campo => $indice_campo) {
	  $elenco_campi_select .= ", ".$nome_campo;
	}
	return "SELECT ".ltrim($elenco_campi_select, ",")." FROM VeicoloNumViaggi NATURAL JOIN Veicolo WHERE NumViaggi  = ( SELECT MAX(NumViaggi) FROM VeicoloNumViaggi );";
}

function bestAutisti($elenco_campi){
	$elenco_campi_select = "";
	foreach($elenco_campi as $nome_campo => $indice_campo) {
	  $elenco_campi_select .= ", ".$nome_campo;
	}
	return "SELECT ".ltrim($elenco_campi_select, ",")." FROM Autista JOIN Passeggero ON Passeggero = CF ORDER BY Rating DESC LIMIT 5;";
}

function worstAutisti($elenco_campi){
	$elenco_campi_select = "";
	foreach($elenco_campi as $nome_campo => $indice_campo) {
	  $elenco_campi_select .= ", ".$nome_campo;
	}
	return "SELECT ".ltrim($elenco_campi_select, ",")." FROM Feedback JOIN Passeggero ON Autista = CF WHERE Voto < 6;";
}

function maxCitta($elenco_campi){
	$elenco_campi_select = "";
	foreach($elenco_campi as $nome_campo => $indice_campo) {
	  $elenco_campi_select .= ", ".$nome_campo;
	}
	return "SELECT ".ltrim($elenco_campi_select, ",")." FROM Citta JOIN CittaNumViaggi ON CodCitta = CittaA WHERE NumViaggi = ( SELECT MAX(NumViaggi) 
			FROM CittaNumViaggi );";
}

function cercaViaggi($elenco_campi, $cittaP, $cittaA){
	$elenco_campi_select = "";
	foreach($elenco_campi as $nome_campo => $indice_campo) {
	  $elenco_campi_select .= ", ".$nome_campo;
	}
	return "SELECT ".ltrim($elenco_campi_select, ",")." FROM Viaggio AS V JOIN Citta AS C1 ON V. CittaP = C1.CodCitta 
			JOIN Citta AS C2 ON CittaA = C2.CodCitta JOIN Veicolo ON Veicolo = Targa
		WHERE C1.Nome = '".$cittaP."' AND C2.Nome = '".$cittaA."' AND PrenotazioniChiuse = false;";
}

function tabella($sql, $elenco_alias){
	$conn = connetti();
	$tabella = "<table class=\"tabella\">\n";
	$tabella .= "<tr>\n"; 
	foreach($elenco_alias as $nome_alias => $indice_alias) {
      $tabella .= "<th>".$nome_alias."</th>\n"; 
	  //$elenco_campi_select .= ", ".$nome_campo;
	}
    $tabella .= "</tr>\n";
   
	$alterna = FALSE;
	
	//$sql = "testo della query"
	$result = pg_query($conn, $sql);

	while ($row = pg_fetch_row($result)) {

        $riga = "<tr class=\"riga\">\n";
		if ($alterna)
			$colore = " azzurro";
		else
			$colore = "";
		$alterna = !$alterna;
		
		foreach($elenco_alias as $nome_alias => $indice_alias) {
			$riga .= "<td class=\"cella".$colore."\">".$row[$indice_alias]."</td>";
		}
        $riga .= "</tr>\n";
        $tabella .= $riga;
      
    }
    $tabella .= "</table>\n";
	return $tabella;
}

function registraUtente($CF, $nome, $cognome, $telefono, $email, $psw){
	$conn = connetti();
	$result = pg_query($conn, "SELECT * FROM Passeggero WHERE CF = '$CF';");
	$row = pg_fetch_row($result);
	$msg = "";
	if(!empty($row)){
		$msg .= "<p class=\"errore\">Esiste già un utente registrato con questi dati</p>";
	}else{
		pg_query($conn, "INSERT INTO Passeggero VALUES ('$CF','$nome','$cognome','$telefono','$email','$psw');");
	}
	return $msg;
}

function isRegistrato($email, $psw){
	$conn = connetti();
	$res = pg_query($conn, "SELECT * FROM Passeggero WHERE Email = '$email';");
	$row = pg_fetch_row($res);
	$msg = "";
	if(empty($row)){
		echo "<p class=\"errore\">Utente non registrato. Assicurati che l'indirizzo email inserito sia corretto.</p>";
		return false;
	}else{
		$res = pg_query($conn, "SELECT * FROM Passeggero WHERE Email = '$email' AND psw = '$psw';");
		$row = pg_fetch_row($res);
		if(empty($row)){
			echo "<p class=\"errore\">La password inserita è errata.</p>";
			return false;
		}
		else{
			 $_SESSION["token"] = rand(0,10000);
			 $_SESSION["nominativo"] = $row[1];
			 return true;
		}	
	}
}


?>