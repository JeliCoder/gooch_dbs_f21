
<head>
	<title>Delete From Table</title>
</head>
<body>
<h1>Delete Instruments</h1>
<?php

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	$dbhost = 'localhost';
	$dbuser = 'webuser';
	$dbpass = 'mewtw';
	$dbname = 'instrument_rentals';

	if (!$conn = new mysqli($dbhost, $dbuser )){
		echo "Error: Failed to make a MySQL connection: " . "<br>";
		echo "Errno $conn->connect_errno; i.e. $conn->connect_error . ";
		exit();
	}

	$sel_tbl = 'SELECT instrument_id, instrument_type 
				FROM instruments';

	if (!$result = $conn->query($sel_tbl)){
		echo "SELECT failed!\n";
		exit();
	}



?>
</body>