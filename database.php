<?php
/**
 * Database class
 *
 */
class Database {
    public $servername;
    public $username;
    public $password;
    public $dbname;

    /**
     * Constructor to initialize the class properties.
     */
    public function __construct($servername, $username, $password, $dbname) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    /**
     * Method to create a database connection
     *
     */
    public function DBConnection() {
        // Step 1: Connect to the MySQL server without specifying a database
        $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Step 2: Create the database if it doesn't exist
        $sql = "CREATE DATABASE IF NOT EXISTS " . $this->dbname;
        if ($conn->query($sql) === TRUE) {
            echo "Database created successfully<br>";
        } else {
            die("Error creating database: " . $conn->error);
        }

        // Step 3: Connect to the specific database
        mysqli_select_db($conn, $this->dbname);

        // Step 4: Create the table if it doesn't exist
        $sql = "CREATE TABLE IF NOT EXISTS profile (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            myname VARCHAR(30) NOT NULL,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";

        if (mysqli_query($conn, $sql)) {
            echo "Table created successfully<br>";
        } else {
            echo "Error creating table: " . mysqli_error($conn);
        }

        // Return the connection object.
        return $conn;
    }
}
?>