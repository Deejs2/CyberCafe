<?php
$serverName = "127.0.0.1";
$userName = "root";
$password = "";
$database = "cyber_cafe";

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
        echo "Database created successfully. ";
    } else {
        echo "Error creating database: " . $connection->error;
        die();
    }
}

// Connect to the specific database
$connection->select_db($database);

// echo "Connected successfully";

// Close the connection (optional, depending on your needs)
// $connection->close();
