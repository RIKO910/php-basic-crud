<?php

require_once "database.php";

$database = new Database("localhost", "root", "", "crud");

if (isset($_POST["submit"])) {
    $myname = $_POST["name"];

    // Establish database connection.
    $conn = $database->DBConnection();

    if ($conn === null) {
        die("Fatal error: Database connection is null. Check your connection parameters.");
    }

    // Insert data into table.
    $sql = "INSERT INTO profile (myname) VALUES (?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Fatal error: Failed to prepare statement. Error: " . $conn->error);
    }
    $stmt->bind_param("s", $myname);

    // Execute the statement
    if ($stmt->execute()) {
        $message = "Record inserted successfully";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP CRUD Operation using OOP</title>
</head>
<body>
<?php if (isset($message)) echo "<p>$message</p>"; ?>
<form action="" method="post">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" >
    <button type="submit" name="submit">Save</button>
</form>
</body>
</html>