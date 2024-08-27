<?php

// Database assign.

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud";

//create connection.

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection.

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to check database create successfully.

$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
}
