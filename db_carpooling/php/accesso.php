<?php
	require_once("testa.php");
	require_once("lib_utenti_db.php");
?>
<form method="post" action="accesso.php">
	<label for = "email">Email</label>
		<input type="text" name="email"/><br>
	<label for = "psw">Password</label>
		<input type="password" name="psw" pattern = ".{8,}" maxlength = "8"/><br>
	<input type="submit" value="Accedi" />
</form>
<?php
	if(!empty($_POST)){
		$email = $_POST["email"];
		$psw = $_POST["psw"];
		echo isRegistrato($email, $psw);
	}
	require_once("coda.php");
?>
