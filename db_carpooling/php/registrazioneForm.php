<?php
  require_once("testa.php");
?>
<form id="registrazione" method="post" action="registrazione.php">
	<?php
	if (isset($_GET["errore"]) && $_GET["errore"] != "")
		echo $_GET["errore"];
	?>
  <fieldset>
    <legend>Inserisci i tuoi dati</legend>
	<label for="nome">Nome*</label><input maxlength="20" type="text" name="nome" />
	<label for="cognome">Cognome*</label><input maxlength="20" type="text" name="cognome" />
	<label for="CF">Codice fiscale*</label><input type="text" name="CF" pattern=".{16,}" maxlength = "16" />
	<label for="email">Email*</label><input maxlength="30" type="text" name="email" />
    <label for="password">Password*</label><input type="password" id="password" name="password" pattern=".{8,}" maxlength = "8"  />
	<label for="telefono">Telefono*</label><input  type="text" pattern=".{10,}"  name="telefono"  maxlength="14"/>
    <input type="submit" value="Iscriviti" />
  </fieldset>
</form>
<?php
  require_once("coda.php");
?>