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

    $myname = $conn->real_escape_string($myname);

    // Insert data into table.
    $sql = "INSERT INTO profile (myname) VALUES ('$myname')";

    if ($conn->query($sql) === true) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
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
