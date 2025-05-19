<?php
//Sequence server, username, password, database name
$env = parse_ini_file(".env");
$servername = "localhost";
$username = "root";
$password = $env['DB_PASSWORD'];
$db_name = "sc_district";

// Production Connection (Uncomment Later)
$conn = mysqli_connect($servername, $username, $password, $db_name);
if (!$conn) {
	die("Connection Error " . mysqli_connect_error());
} else {
}

// Test Connection (Uncomment To use)
// $conn = null;
