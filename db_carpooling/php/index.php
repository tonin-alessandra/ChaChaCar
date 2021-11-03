<?php
	require_once("testa.php");
	if(isset($_GET["msg"]) && $_GET["msg"] != "") echo $_GET["msg"];
?>
	<div id = "slogan"></div>
	<div id = "index"></div>
<?php
	require_once("coda.php");
?>
