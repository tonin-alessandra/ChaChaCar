<?php
require_once("lib_utenti_db.php");

$errore = "";

$nome = $_POST["nome"];
$cognome = $_POST["cognome"];
$CF = $_POST["CF"];
$email = $_POST["email"];
$psw = $_POST["password"];
$telefono = $_POST["telefono"];

//Controllo se l'utente non ha inserito i dati
if ( !(isset($nome) && $nome != NULL) )
	$errore = "<p class=\"errore\">Campo <em>nome</em> obbligatorio</p>";

if ( !(isset($cognome) && $cognome != NULL) )
	$errore .= "<p class=\"errore\">Campo <em>cognome</em> obbligatorio</p>";

if ( !(isset($CF) && $CF != NULL) )
	$errore .= "<p class=\"errore\">Campo <em>Codice Fiscale</em> obbligatorio</p>";

if ( !(isset($email) && $email != NULL) )
	$errore .= "<p class=\"errore\">Campo <em>email</em> obbligatorio</p>";

if ( !(isset($psw) && $psw != NULL) )
	$errore .= "<p class=\"errore\">Campo <em>Password</em> obbligatorio</p>";

if ( !(isset($telefono) && $telefono != NULL) )
	$errore .= "<p class=\"errore\">Campo <em>telefono</em> obbligatorio</p>";

if ( $errore == "" ) {
	// Salvataggio nel database
	$msg = registraUtente($CF, $nome, $cognome, $telefono, $email, $psw);
    if($msg != "")
		header("Location: registrazioneForm.php?errore=".$msg);	
	else{
		$msg = "<p class=\"msg\">Utente registrato.</p>";
		header("Location: login.php?msg=".$msg);
	}
}
else
	header("Location: registrazioneForm.php?errore=".$errore);
?>