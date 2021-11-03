<?php session_start(); ?>
<html>
<head>
<link rel="shortcut icon" href="../img/icona.ico" />
<title>ChaChaCar</title>
<link type="text/css" rel="stylesheet" href="../css/stili.css" />
</head>
<body>
  <div id="container">
  <a href="index.php"><div id="top"></div></a>
    <div id="topnav">
		<div id="topnavcontainer">
		<?php 
		// Se l'utente è registrato, ne visualizzo il nominativo (messo sulla sessione in fase di accesso)
		if ( isset($_SESSION["token"]) && $_SESSION["nominativo"] != "" ) {
			echo "<span class=\"nominativo\"> Ciao ".$_SESSION["nominativo"]."!</span>";
		}
		else{
			echo "<ul><li><a href=\"login.php\">Accedi</a></li>";
			echo "<li><a href=\"registrazioneForm.php\">Registrati</a></li></ul>";
		}
		?>   
		</div>	
	</div>
	<div id="leftnav">
    <div id="leftnavcontainer">
    <?php
	//Se c'è un utente che ha effettuato il login visualizzo un menù con in più il logout
    if ( isset($_SESSION["token"]) )
		include("menu_registrato.html");
    // Altrimenti visualizzo il menù per gli utenti non registrati
    else
      include("menu.html");         
    ?>  
    </div> 
	</div> 
	<div id="content">
 
