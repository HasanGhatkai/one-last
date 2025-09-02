<?php include 'track_visitor.php'; ?>
<?php include 'cursor-effect.html'; ?>
<?php
// MySQL database connection details
$host = "localhost";
$db = "star cyber cafe";  // Replace with your database name
$user = "root";           // Replace with your database username
$pass = "";               // Replace with your database password (default is empty in XAMPP)

// Create a new MySQLi connection
$conn = new mysqli($host, $user, $pass, $db);

// Handle AJAX "Load More"
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['load_more'])) {
    $cat_id = intval($_POST['category_id']);
    $offset = intval($_POST['offset']);

    // Prepared statement for security
    $query = "SELECT id, title FROM posts WHERE category_id = ? AND status = 'active' ORDER BY date_posted DESC LIMIT 3 OFFSET ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $cat_id, $offset); // 'ii' for two integer parameters
    $stmt->execute();
    $result = $stmt->get_result();

    $html = '';
    if ($result->num_rows > 0) {
        while ($post = $result->fetch_assoc()) {
            $html .= '<li class="list-group-item">
                        <a href="job_details.php?id=' . htmlspecialchars($post['id']) . '" class="text-decoration-none text-dark">
                            <i class="fas fa-angle-right me-2 text-primary"></i>' . htmlspecialchars($post['title']) . '
                        </a>
                      </li>';
        }
    }
    echo $html;
    exit; // IMPORTANT: Stop script execution for AJAX requests
}

// Normal page load continues below
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs by Category - Star Cyber Cafe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Basic styling to ensure button visibility and basic layout */
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .card-header {
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .list-group-item {
            border-bottom: 1px solid rgba(0,0,0,.125);
        }
        .list-group-item:last-child {
            border-bottom: none;
        }
        .load-more-btn {
            border-radius: 20px;
            padding: 8px 20px;
        }
        .text-dark { /* Ensure text is visible if Bootstrap's default isn't enough */
            color: #343a40 !important;
        }
    </style>
</head>
<body>

<div class="container mt-3">
    <div class="row">
        <?php
        
// Check if connection is closed or not set
if (!isset($conn) || !$conn instanceof mysqli || !@$conn->ping()) {
    // Reconnect
    $conn = new mysqli("localhost", "root", "", "star cyber cafe");

    if ($conn->connect_error) {
        die("Reconnection failed: " . $conn->connect_error);
    }
}


        // Fetch categories from the database
        // $cat_query = "SELECT id, name FROM categories ORDER BY name ASC"; // Order categories alphabetically
        $cat_query = "SELECT id, name FROM categories ORDER BY id ASC";
        $cat_result = mysqli_query($conn, $cat_query);

        if ($cat_result && mysqli_num_rows($cat_result) > 0) {
            while ($category = mysqli_fetch_assoc($cat_result)) {
                $cat_id = htmlspecialchars($category['id']);
                $cat_name = htmlspecialchars($category['name']);

                // Get 5 initial posts using a prepared statement for security
                $post_query_initial = "SELECT id, title FROM posts WHERE category_id = ? AND status = 'active' ORDER BY date_posted DESC LIMIT 5";
                $stmt_initial = $conn->prepare($post_query_initial);
                $stmt_initial->bind_param("i", $cat_id); // 'i' for integer parameter
                $stmt_initial->execute();
                $post_result_initial = $stmt_initial->get_result();
        ?>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h5><i class="fas fa-briefcase me-2"></i><?php echo $cat_name; ?></h5>
                    <small>Latest <?php echo $cat_name; ?> Jobs</small>
                </div>
                <ul class="list-group list-group-flush" id="post-list-<?php echo $cat_id; ?>">
                    <?php
                    if ($post_result_initial->num_rows > 0) {
                        while ($post = $post_result_initial->fetch_assoc()) {
                    ?>
                        <li class="list-group-item">
                            <a href="job_details.php?id=<?php echo htmlspecialchars($post['id']); ?>" class="text-decoration-none text-dark">
                                <i class="fas fa-angle-right me-2 text-primary"></i><?php echo htmlspecialchars($post['title']); ?>
                            </a>
                        </li>
                    <?php
                        }
                    } else {
                        echo '<li class="list-group-item text-muted text-center">No jobs found in this category.</li>';
                    }
                    
                    ?>
                </ul>
                <div class="card-body text-center">
                    <?php
                    // Check if there are more posts to load than initially displayed
                    $total_posts_query = "SELECT COUNT(*) AS total FROM posts WHERE category_id = ? AND status = 'active'";
                    $stmt_total = $conn->prepare($total_posts_query);
                    $stmt_total->bind_param("i", $cat_id);
                    $stmt_total->execute();
                    $total_posts_result = $stmt_total->get_result();
                    $total_posts_row = $total_posts_result->fetch_assoc();
                    $total_posts = $total_posts_row['total'];
                    $stmt_total->close();

                    if ($total_posts > 5) { // If total posts are more than initial 5, show load more button
                    ?>
                    <button class="btn btn-outline-primary btn-sm load-more-btn"
                        data-category-id="<?php echo $cat_id; ?>"
                        data-offset="5">View Whole Details
                    </button>
                    <?php } else { ?>
                    <button class="btn btn-outline-secondary btn-sm" disabled>No More Jobs</button>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
            } // End while for categories
        } else {
            echo '<div class="col-12"><p class="alert alert-warning text-center">No categories found.</p></div>';
        }
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(".load-more-btn").on("click", function () {
        let categoryId = $(this).data("category-id");
        let offset = $(this).data("offset");

        // Redirect to vacancies_listing_page.php with category and offset as GET parameters
        window.location.href = "vacancies_listing_page.php?category_id=" + categoryId + "&offset=" + offset;
    });
</script>

</body>
</html>