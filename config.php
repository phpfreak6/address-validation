<?php
// Connect to MySQL Database
$servername = "localhost";		// database server name
$username = "root";				// database user name
$password = "";					// database password

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// Create database
$dbName = "my_testDB";		// database name

$sql = "CREATE DATABASE IF NOT EXISTS $dbName";
if (empty (mysqli_fetch_array(mysqli_query($conn,"SHOW DATABASES LIKE '$dbName'")))){
	if ($conn->query($sql) === TRUE) {
		// echo "Database created successfully";
	} else {
		echo "Error creating database: " . $conn->error;
	}
}

$retval = mysqli_select_db( $conn, $dbName );
$mysqli = new mysqli($servername, $username, $password, $dbName);
$show = $mysqli->query("SHOW TABLES from my_testDB");
$results = mysqli_fetch_row($show);
$tbl = "CREATE TABLE tbl_addresses(
	id int(11) NOT NULL AUTO_INCREMENT,
	address longtext,
	PRIMARY KEY ( id )
)";
if (empty($results)){
	if ($mysqli->query($tbl) === TRUE) {
		// echo 'Table created.';
	}else{
		echo 'Error creating table';
	}
}
$conn->close();
?>