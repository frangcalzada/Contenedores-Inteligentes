<?php
	$servername = "localhost";
	$username = "root";
	$password = "123456";
	$databasename = "smart_trash";
	// Crea la Conexión
	$conn = new mysqli($servername, $username, $password, $databasename);	
?>
<center>
	<table class="table is-hoverable is-striped ">
		
		<thead>
			<tr>
				<th><center>Tiempo</center></th>
				<th><center>Temperatura (C)</center></th>
				<th><center>Humedad (%)</center></th>
				<th><center>Nivel (%)</th></center>
				<th><center>Humedad</center></th>
				<th><center>Uso</center></th>
			</tr>
		</thead>
		<tbody>
		
			<?php
				$sql = "SELECT * FROM binData8 ORDER BY time DESC LIMIT 24";
				$result = $conn->query($sql);

				while($row = $result->fetch_assoc())
					{
					echo(	"<tr>
							<td><center>" .$row["time"]. "</center></td>
							<td><center>". $row["temp"]. "</center></td>
							<td><center>". $row["humid"]. "</center></td>
							<td><center>" . $row["lvl"] . "</center></td>
							<td><center>" . $row["mois"] . "</center></td>
							<td><center>" . $row["opn"] . "</center></td>
							</tr>");
					}
				$conn->close();
			?>
		
		</tbody>
	</table>
	<div id="tablediscribe">
		<p class="is-size-7">Los últimos 24 datos mostrados.</p>
	</div>
</center>

