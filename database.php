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

// sql to create table.

$sql = "CREATE TABLE IF NOT EXISTS profile (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    myname VARCHAR(30) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

// sql to check table create successfully.

if(mysqli_query($conn, $sql)){
    echo "Table created successfully";
}else{
    echo "Error creating table: " . mysqli_error($conn);
}

// Close mysql.

mysqli_close($conn);