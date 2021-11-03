<?php
	require_once("testa.php");
	require_once("lib_utenti_db.php");

?>
	<form id="inserimento" method="post" action="cercaViaggi.php">
		<label for="nome">Inserisci la città di partenza</label>
			<select name="cittaP">
			<?php 
				$conn = connetti();
				$result = pg_query($conn, "SELECT Nome FROM Citta");
				while ($row = pg_fetch_row($result)) {
					echo "<option value=".$row[0].">".$row[0]."</option>";
				}
				
			?>
			</select>
		<label for="nome">Inserisci la città di arrivo</label>
			<select name="cittaA">
			<?php 
				$result = pg_query($conn, "SELECT Nome FROM Citta");
				while ($row = pg_fetch_row($result)) {
					echo "<option value=".$row[0].">".$row[0]."</option>";
				}
				
			?>
			</select>
		<input type="submit" value="Invia" />
	</form>
	
<?php	
	require_once("coda.php");
?>
