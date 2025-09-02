<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "star cyber cafe";  

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$ip = $_SERVER['REMOTE_ADDR'];

// prevent multiple entries in 30 minutes
$sql = "SELECT * FROM visitors WHERE ip_address = ? AND visit_time > (NOW() - INTERVAL 30 MINUTE)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $ip);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
  $insert = $conn->prepare("INSERT INTO visitors (ip_address) VALUES (?)");
  $insert->bind_param("s", $ip);
  $insert->execute();
}
?>
