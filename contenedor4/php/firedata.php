<?php
	$servername = "localhost";
	$username = "root";
	$password = "123456";
	$databasename = "smart_trash";
	// Crea la conexión
	$conn = new mysqli($servername, $username, $password, $databasename);			

	$dbdata = array();
	$sql = "SELECT * FROM fireData4 ORDER BY time DESC LIMIT 1";
	$result = $conn->query($sql);
	
	while($ligne = $result->fetch_assoc())
		{
		$dbdata[]=$ligne;
		}
	echo json_encode($dbdata);
	
?>