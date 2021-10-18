<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	$dbhost = 'localhost';
	$dbuser = 'jeligooch';
	$dbpass = 'charmander';
	$db = 'red_river_climbs';

	$conn = new mysqli($dbhost, $dbuser, $dbpass, $db);

	if ($conn->connect_errno) {
		echo "Error: Failed to make a MySQL connection, 
			here is why: ". "<br>"; 
		echo "Errno: " . $conn->connect_errno . "\n"; 
		echo "Error: " . $conn->connect_error . "\n"; 
		exit; // Quit this PHP script if the connection fails. 
	} else { 
		echo "Connected Successfully!" . "<br>"; 
		echo "YAY!" . "<br>"; 
	}

	$dblist = "SHOW databases;";

	$result = $conn->query($dblist);

	while ($dbname = $result->fetch_array()) {
		echo $dbname['Database'] . "<br>";
	}

	

	$dbtable = "SHOW TABLES;";

	$results = $conn->query($dbtable);

	"Here are list of all our tables";
	foreach($results as $db_row)
	{
		echo " " . "<br>";
		echo implode($db_row) ; 
	}

	$conn->close();

?>

<h2>Check back soon!</h2>

