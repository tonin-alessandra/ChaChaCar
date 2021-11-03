<?php
	require_once("testa.php");
	require_once("lib_utenti_db.php");
	if(isset($_GET["msg"]) && $_GET["msg"] != "") echo $_GET["msg"];
?>
<form method="post" action="login.php">
	<label for = "email">Email</label>
		<input type="text" name="email"/><br>
	<label for = "psw">Password</label>
		<input type="password" name="psw" pattern=".{8,}" maxlength = "8"/><br>
	<input type="submit" value="Accedi" />
</form>
<?php
	if(!empty($_POST)){
		$email = $_POST["email"];
		$psw = $_POST["psw"];
		if(isRegistrato($email, $psw)) header("Location: index.php");
	}
	require_once("coda.php");
?>
