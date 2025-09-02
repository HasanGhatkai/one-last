<?php
// Step 1: Connect to the database
$conn = new mysqli("localhost", "root", "", "star cyber cafe"); // 🔁 Replace with your DB name

// Step 2: Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 3: Fetch first 5 post titles and IDs
$sql = "SELECT id, title FROM posts WHERE status = 'active' ORDER BY date_posted DESC LIMIT 10";
$result = $conn->query($sql);

// Step 4: Build clickable list
$headlines = "";

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $title = htmlspecialchars($row['title']); // secure output
        $headlines .= "<a href='job_details.php?id=$id' target='_blank' style='color:#000; text-decoration:none;'>$title</a> &nbsp; | &nbsp; ";
    }
    echo rtrim($headlines, " &nbsp; | &nbsp; ");
} else {
    echo "No posts available.";
}

$conn->close();
?>
