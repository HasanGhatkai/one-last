<?php


// MySQL database connection details
$host = "localhost";
$db = "star cyber cafe";  // Replace with your database name
$user = "root";           // Replace with your database username
$pass = "";               // Replace with your database password (default is empty in XAMPP)

// Create a new MySQLi connection
$conn = new mysqli($host, $user, $pass, $db);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
