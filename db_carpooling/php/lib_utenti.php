<?php


// Equivale alla funzione PHP implode(): trasforma un array
// in una stringa contenente gli elementi dell'array separati
// dal carattere fornito come parametro ($sep).
function implodi($array, $sep)
{
  $lista = "";
  if ( isset($array) && count($array) > 0 ) {
    foreach ($array as $token)
      $lista .= $token.$sep;
    $lista = rtrim($lista,$sep);
  }
  return $lista; 
}

function registraUtente($nome, $cognome, $sesso, $titolo, $indirizzo, $citta, $CF, $data, $email, $password)
{
  $errore = "";
  //print_r($titolo);
  // Controllo se l'utente esiste già
  // TODO: effettuare il controllo per apertura file fallita
  $f = fopen("utenti.txt", "a+"); // modalità append!
	// Posiziona il puntatore di lettura ad inizio file (il puntatore
	// di scrittura rimane a fine file: append); equivale a fseek($f, 0);
  rewind($f);

  while ( !feof($f) && $errore == "" ) {
    $riga = fgets($f);
    if ( trim($riga) != "" ) {
      $array_utente = explode('|', $riga);
      // Nel file CSV, l'email corrisponde al campo in posizione 8 (da 0)
      if ( $array_utente[8] == $email )
          $errore = "L&rsquo;utente con e-mail ".$email." esite gi&agrave;!";
    }
  }

  // Se non ci sono errori salvo i dati dell'utente
  if ( $errore == "" )
      // Cripto la password nel file con l'algoritmo md5
      // TODO: gestire l'eventuale errore
      fwrite($f, $nome."|".$cognome."|".$sesso."|".implodi($titolo, ";")."|".$indirizzo."|".$citta."|".$CF."|".$data."|".$email."|".md5($password)."\r\n");
  exit();
  fclose($f);
  return $errore;
}

function isRegistrato($email, $password)
{
    // TODO: prevedere la gestione dell'errore
    $errore = "";
    $autenticato = FALSE;
    
    // Verifico l'esistenza dell'utente nel file
    $f = fopen("utenti.txt","r");

    while ( !feof($f) && $autenticato == FALSE ) {
        $riga = fgets($f);
        if ( trim($riga) != "" ) {
          $array_riga = explode('|', $riga);
          //print_r($array_riga);
          // Confronto le due stringhe. Attenzione: ciò può essere fatto tramite
          // l'operatore == che, diversamente dal c/c++ non confronta gli indirizzi (causa di errori)
          // Il confronto tramite == non è case sensitive, a tale scopo si utilizza la funzione
          // strcmp(), vedi:
          // http://stackoverflow.com/questions/3333353/string-comparison-using-vs-strcmp
          if ( $array_riga[EMAIL] == $email ) {
              //print_r($array_riga);
              // L'utente esiste (email), verifico che la password corrisponda           
              if ( trim($array_riga[PASSWORD]) == md5(trim($password)) ) {
                  $autenticato = TRUE;
                  // Certifico l'avvenuta autenticazione
                  $_SESSION["token"] = rand(0,10000);
                  $_SESSION["tipo"] = $array_riga[TIPO];                
                  $_SESSION["nominativo"] = $array_riga[NOME]." ".$array_riga[COGNOME];
              }
          }
        }
    }
    fclose($f);
    return $autenticato;
}

function creaTabellaDaFile($nome_file, $sep, $elenco_campi, $salta_prima) 
{
  $errore = "";
  $tabella = "<table class=\"tabella\">\n";
  //$elenco_campi = creaArrayDaStringa($stringa_campi, $modo);
  $f = fopen($nome_file, "r");
  if ($f) {
    // Creo l'intestazione utilizzando l'array contenente l'elenco dei campi: $elenco_campi
    $tabella .= "<tr>\n"; 
    foreach($elenco_campi as $nome_campo => $indice_campo)
      $tabella .= "<th>".$nome_campo."</th>\n"; 
    $tabella .= "</tr>\n";
    // Se c'è la prima riga di intestazione non la processo: la salto con una lettura
    if ($salta_prima)
      fgets($f);
	$alterna = FALSE;
    while ( !feof($f) ) {
      $riga = trim(fgets($f));
      // Controllo la presenza di una eventuale riga vuota.
      if ($riga != "") {
        $array_riga = explode($sep, $riga);
        $riga = "<tr class=\"riga\">\n";
		if ($alterna)
			$colore = " azzurro";
		else
			$colore = "";
		$alterna = !$alterna;
        foreach($elenco_campi as $nome_campo => $indice_campo) {
          $riga .= "<td class=\"cella".$colore."\">".$array_riga[$indice_campo]."</td>";
        }
        $riga .= "</tr>\n";
        $tabella .= $riga;
      }
    }
    $tabella .= "</table>\n";
  }
  else
    $errore = "Errore di apertura del file ".$nome_file;
  
  if ($errore != "")
    $tabella = "";
  //
  return $tabella;
}
?>
