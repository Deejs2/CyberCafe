<?php
$serverName = "127.0.0.1";
$userName = "root";
$password = "";
$database = "cybercafe";

//create connection
$connection = new mysqli($serverName, $userName, $password);

//check connection
if($connection->connect_error){
    die("connection failed! : ".$connection->connect_error);
}

// Check if the database exists
if (!$connection->select_db($database)) {
    // If the database doesn't exist, create it
    $createDatabaseQuery = "CREATE DATABASE IF NOT EXISTS $database";

    if ($connection->query($createDatabaseQuery) === TRUE) {
        echo "<script>console.log('Database created successfully')</script>";
    } else {
        echo "Error creating database: " . $connection->error;
        die();
    }
}

// Connect to the specific database
$connection->select_db($database);

echo "<script>console.log('Connected to the database successfully')</script>";

//// Close the connection (optional, depending on your needs)
//$connection->close();
