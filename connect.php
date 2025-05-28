<?php
//Sequence server, username, password, database name
$env = parse_ini_file(".env");
$servername = $env['DB_SERVERNAME'];
$username = $env['DB_USERNAME'];
$password = $env['DB_PASSWORD'];
$db_name = $env['DB_NAME'];

// Production Connection (Uncomment Later)
$conn = mysqli_connect($servername, $username, $password, $db_name);
if (!$conn) {
	die("Connection Error " . mysqli_connect_error());
} else {
}

// Test Connection (Uncomment To use)
// $conn = null;
