<?php
// db_connection.php
$servername = "localhost";
$username = "root"; // Replace with your MySQL username, typically 'root' for XAMPP
$password = "";     // Replace with your MySQL password, often blank for XAMPP
$database = "user_registration"; // Your database name
$port = 3306;       // The port number (default is 3306)

// Create connection
$conn = new mysqli($servername, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>