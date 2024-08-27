<?php

require_once "database.php";

// Instantiate the database connection
$database = new Database("localhost", "root", "", "crud");

// Establish database connection.
$conn = $database->DBConnection();

if ($conn === null) {
    die("Fatal error: Database connection is null. Check your connection parameters.");
}

// Handle delete request
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $delete_sql = "DELETE FROM profile WHERE id = $id";
    if ($conn->query($delete_sql) === true) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Handle update request
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $new_name = $conn->real_escape_string($_POST['new_name']);
    $update_sql = "UPDATE profile SET myname = '$new_name' WHERE id = $id";
    if ($conn->query($update_sql) === true) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Fetch records from the database
$sql = "SELECT id, myname FROM profile";
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
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <p>My name is <?= htmlspecialchars($row['myname']) ?></p>

        <!-- Delete button form -->
        <form action='' method='POST' style='display:inline-block;'>
            <input type='hidden' name='id' value='<?= $row['id'] ?>'>
            <button type='submit' name='delete'>Delete</button>
        </form>

        <!-- Update button form -->
        <form action='' method='POST' style='display:inline-block;'>
            <input type='text' name='new_name' placeholder='Enter new name'>
            <input type='hidden' name='id' value='<?= $row['id'] ?>'>
            <button type='submit' name='update'>Update</button>
        </form>
        <br><br>
        <?php
    }
} else {
    echo "No records found.";
}
?>
</body>
</html>
