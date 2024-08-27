<?php

require_once "database.php";

// Instantiate the database connection
$database = new Database("localhost", "root", "", "crud");

// Establish database connection.
$conn = $database->DBConnection();

if ($conn === null) {
    die("Fatal error: Database connection is null. Check your connection parameters.");
}

$sql = "SELECT myname FROM profile";
$result = $conn->query($sql);
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile</title>
</head>
<body>
<?php
// Display the fetched data
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "My name is " . $row['myname'] . "<br>";
    }
} else {
    echo "No records found.";
}
?>
</body>
</html>
