<?php
include "config.php";


session_start();

// Redirect if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: admin/dashboard/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <link rel="icon" href="image/cropped_circle_image.png" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Modern Sarkari Job Portal for latest government job updates, results, admit cards, and syllabus in India.">
    <meta name="keywords" content="Sarkari Result, Sarkari Job, Government Jobs, Modern Job Portal, Latest Jobs, Admit Card, Syllabus, Answer Key">
    <title>Star Cyber Cafe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="Header.php">
    <link rel="stylesheet" href="Footer.php">

    <style>
        /* --- Modern & Streamlined Theme --- */

        :root {
--bootstrap-primary-blue: #0d6efd; /* Standard Bootstrap Primary Blue */
    --bootstrap-primary-hover: #0a58ca; /* Darker blue for hover states */
    --bootstrap-text-dark: #212529; /* Standard dark text for light backgrounds */
    --bootstrap-medium-gray: #e9ecef; /* Slightly darker gray for subtle backgrounds/borders */

    /* General Site Theme Variables (ensure these are consistent with your main stylesheet) */
    --card-background-color: #ffffff; /* White background for cards */
    --text-color: #333333; /* General dark text color */
    --shadow-subtle: rgba(0, 0, 0, 0.075); /* Very light shadow */
    --shadow-medium: rgba(0, 0, 0, 0.175); /* Medium shadow */
    --transition-duration: 0.3s; /* Global transition speed */
    --font-primary: 'Roboto', 'Helvetica Neue', Arial, sans-serif; /* Your site's base font */
    --font-secondary: 'Lato', sans-serif; /* Your site's secondary font for headings/titles */            

            /* Override Bootstrap variables */
            --bs-primary: var(--primary-color);
            --bs-secondary: var(--secondary-color);
            --bs-primary-rgb: 0, 128, 128;
            --bs-secondary-rgb: 0, 77, 77;
            --bs-body-bg: var(--background-color);
            --bs-body-color: var(--text-color);
            --bs-link-color: var(--link-color);
            --bs-link-hover-color: var(--secondary-color);
            --bs-border-color: var(--border-color);
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-primary);
            background-color: #ffffff; /* Set background to white */
            color: var(--bs-body-color); /* Text color from Bootstrap theme */
            line-height: 1.6;
        }


        /* --- Header --- */
        .site-header {
            background-color: #f8f9fa; /* Lighter background for a fresh feel */
            border-bottom: 1px solid #e9ecef; /* Subtle border */
        }

        .btn-gradient {
            background: linear-gradient(45deg, var(--primary-color));
            border: none;
            color: white; /* Keep button text white for readability */
            font-family: var(--font-secondary);
            font-size: 1em;
            font-weight: 700;
            text-decoration: none;
            transition: background 0.3s ease;
            padding: 0.5em 1.5em;
            border-radius: 50px; /* Rounded pill shape */
        }
        

        .search-container .input-group:focus-within {
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25); /* Focus effect for search */
        }
        .logo-area { display: flex; align-items: center; }
        .lottie-logo-container { width: 50px; height: 50px; margin-right: 12px; }

        .site-title-modern {
            font-family: var(--font-secondary);
            font-size: 1.6em;
            color: var(--primary-color) !important; /* Important to override Bootstrap if 'a' tag is used */
            font-weight: 700;
            text-decoration: none;
        }

        .header-search input[type="search"] {
            border-radius: 20px 0 0 20px;
            border: 1px solid var(--bs-border-color);
            outline-color: var(--accent-color);
        }
         .header-search input[type="search"]::placeholder { color: #999; }
        .header-search button {
            background-color: var(--primary-color);
            border-radius: 0 20px 20px 0;
            color: white;
            transition: background-color 0.3s;
        }
        .header-search button:hover { background-color: var(--secondary-color); }


        /* --- Quick Access Section --- */
        .quick-access-section { background-color: var(--card-background-color); }
        .quick-access-item {
            background-color: var(--primary-color);
            color: white !important; /* Override Bootstrap link colors */
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.2s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .quick-access-item:hover {
            background-color: var(--secondary-color);
            transform: translateY(-5px);
        }
        .quick-access-item h3 {
            margin-top: 0; margin-bottom: 8px; font-size: 1.1em; font-family: var(--font-secondary);
        }
        .quick-access-item p { font-size: 0.85em; margin-bottom: 0; opacity: 0.9; }
        .quick-access-item.results { background-color: #00BFA5; }
        .quick-access-item.results:hover { background-color: #008c76; }
        .quick-access-item.admit-card { background-color: #FFB300; }
        .quick-access-item.admit-card:hover { background-color: #E69500; }
        .quick-access-item.syllabus { background-color: #673AB7; }
        .quick-access-item.syllabus:hover { background-color: #512DA8; }


        /* --- Main Content Area (Specific 3-column cards from previous request) --- */
        .job-listing-cards-section .card-header {
            background-color: var(--primary-color) !important; /* Ensure it uses theme color */
        }
        .job-listing-cards-section .card {
            border-color: var(--primary-color) !important;
            box-shadow: var(--box-shadow);
            height: 100%; /* For equal height cards in a row */
        }
        .job-listing-cards-section .list-group-item a {
            color: var(--text-color); /* Match user's theme for link text */
            text-decoration: none;
        }
         .job-listing-cards-section .list-group-item a:hover {
            color: var(--primary-color);
            text-decoration: underline;
        }
        .job-listing-cards-section .btn {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
        }
         .job-listing-cards-section .btn:hover {
            background-color: var(--secondary-color) !important;
            border-color: var(--secondary-color) !important;
        }

        /* Your Custom Content Sections & Info Cards */
        .content-section {
    background-color: var(--card-background-color); /* Uses white background */
    padding: 25px;
    border-radius: 8px;
    box-shadow: var(--box-shadow); /* Uses existing box-shadow variable */
    margin-bottom: 30px; /* Added spacing */
}

.section-heading {
    font-family: var(--font-secondary);
    font-size: 1.8em;
    color: var(--bootstrap-primary-blue); /* Heading color set to Bootstrap Primary Blue */
    margin-top: 0;
    margin-bottom: 25px;
    border-bottom: 3px solid var(--bootstrap-primary-blue); /* Underline color set to Bootstrap Primary Blue */
    padding-bottom: 12px;
}

.info-card {
    background-color: #fff; /* White background for individual cards */
    border: 1px solid var(--bootstrap-medium-gray); /* Border color set to a subtle Bootstrap gray */
    border-left-width: 5px; /* Keep this distinctive feature */
    border-left-color: var(--bootstrap-primary-blue); /* Left border color set to Bootstrap Primary Blue */
    border-radius: 6px;
    padding: 18px;
    margin-bottom: 18px;
    transition: box-shadow 0.3s, transform 0.2s;
}

.info-card:hover {
    box-shadow: 0 8px 20px rgba(13, 110, 253, 0.15); /* Hover shadow with a hint of primary blue */
    transform: translateY(-3px);
}

/* Specific border-left-colors for different card types (unchanged as they are specific overrides) */
.info-card.admit-card-type { border-left-color: #FFB300; }
.info-card.result-type { border-left-color: #00BFA5; }
.info-card.syllabus-type { border-left-color: #673AB7; }
.info-card.news-type { border-left-color: #78909C; }

.info-card-title {
    font-family: var(--font-secondary);
    font-size: 1.15em;
    margin-top: 0;
    margin-bottom: 8px;
}

.info-card-title a {
    text-decoration: none;
    color: var(--bootstrap-text-dark); /* Title link color set to dark Bootstrap text color */
    transition: color 0.3s;
}

.info-card-title a:hover {
    color: var(--bootstrap-primary-blue); /* Title link hover color set to Bootstrap Primary Blue */
}

.info-card-meta {
    font-size: 0.85em;
    color: #777; /* Keep existing gray for meta info */
    margin-bottom: 10px;
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
}

.info-card-description {
    font-size: 0.9em;
    color: #555; /* Keep existing gray for description text */
    margin-bottom: 15px;
}

.info-card-link a {
    text-decoration: none;
    color: var(--bootstrap-primary-blue); /* Link color set to Bootstrap Primary Blue */
    font-weight: bold;
    font-size: 0.9em;
}

.info-card-link a:hover {
    color: var(--bootstrap-primary-hover); /* Link hover color set to darker Bootstrap blue */
    text-decoration: underline;
}
        /* --- Footer --- */
        .site-footer {
            background-color: var(--secondary-color);
            color: #e0e0e0;
            padding: 40px 25px 20px;
            text-align: center;
        }
        .footer-social-links a { color: white; margin: 0 10px; font-size: 1.5em; text-decoration: none; transition: color 0.3s, transform 0.2s; display: inline-block; }
        .footer-social-links a:hover { color: var(--accent-color); transform: scale(1.1); }
        .footer-nav ul { list-style: none; padding: 0; margin: 20px 0; display: flex; justify-content: center; flex-wrap: wrap; }
        .footer-nav li { margin: 0 10px; }
        .footer-nav a { color: #bdc3c7; text-decoration: none; font-size: 0.9em; }
        .footer-nav a:hover { color: white; text-decoration: underline; }
        .footer-copyright p { margin: 0; font-size: 0.85em; }

        #refresh-loader {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: white;
  z-index: 9999;
  display: flex;
  justify-content: center;
  align-items: center;
}

.spinner {
  width: 50px;
  height: 50px;
  border: 5px solid #007bff;
  border-top: 5px solid transparent;
  border-radius: 50%;
  animation: spin 0.8s linear infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}


    </style>
</head>
<body>

<?php include 'Header.php'; ?>
<?php include 'category_listing_section.php'; ?>

<!-- dynamic services start -->
 <?php
// db.php connection assumed
$conn = new mysqli("localhost", "root", "", "star cyber cafe");
$sql = "SELECT * FROM services";
$stmt = $conn->prepare($sql);
// $result = $conn -> query("SELECT * FROM services");
?>

<section id="services" class="py-5" style="background-color: transparent;">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold text-primary">What We Offer</h2>
      <p class="text-muted">Professional services at Star Cyber Cafe</p>
    </div>
    <div class="row g-4">

      <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="col-lg-6">
          <div class="d-flex bg-white p-4 rounded shadow-sm align-items-center h-100" style="border: 1px solid #e4e7eb;">
            <i class="<?= htmlspecialchars($row['icon']) ?> fa-2x text-primary me-4"></i>
            <div>
              <h5 class="mb-1 fw-bold text-dark"><?= htmlspecialchars($row['title']) ?></h5>
              <p class="mb-0 text-secondary"><?= htmlspecialchars($row['description']) ?></p>
            </div>
          </div>
        </div>
      <?php } ?>

    </div>
  </div>
</section>

<?php
// PHP logic for the "Recent Updates" section
// This code assumes 'admin/database/config.php' is included BEFORE this snippet
// and that it correctly establishes a $conn variable (a mysqli connection).

// Fetch 5 active posts, joining with the 'categories' table to get the category name.
// We select columns from 'posts' and the 'name' column from 'categories'.
// 'p.category_id' should match 'c.id'.
$recent_updates_query = "
    SELECT 
        p.id, 
        p.title, 
        p.date_posted, 
        p.vacancy_count, 
        p.rich_text_description,
        c.name AS category_name  -- Alias the category name to avoid conflict with post title
    FROM 
        posts AS p
    JOIN 
        categories AS c ON p.category_id = c.id
    WHERE 
        p.status = 'active' 
    ORDER BY 
        p.date_posted DESC 
    LIMIT 5
";
$recent_updates_result = mysqli_query($conn, $recent_updates_query);

// Check if query executed successfully
if (!$recent_updates_result) {
    // In a production environment, you might log this error instead of dying.
    die("Recent Updates Query failed: " . mysqli_error($conn) . " SQL: " . $recent_updates_query);
}
?>

<div class="container mt-4">
    <main id="home" class="content-section mb-4">
        <h2 class="section-heading">Recent Updates</h2>
        <div class="content-grid">
            <?php
            // Check if there are results to display
            if (mysqli_num_rows($recent_updates_result) > 0) {
                while ($row = mysqli_fetch_assoc($recent_updates_result)):
                    // Sanitize and prepare data for display
                    $job_id = htmlspecialchars($row['id']);
                    $job_title = htmlspecialchars($row['title']);
                    $date_posted_formatted = date('d M Y', strtotime($row['date_posted']));
                    // Vacancy count is still fetched but will not be displayed in this new design
                    $category_name_display = htmlspecialchars($row['category_name']);

                    // Conditional check: Only show the entire card if critical data exists.
                    // If title, category name, or date posted are empty, skip this card.
                    if (empty($job_title) || empty($category_name_display) || empty($date_posted_formatted)) {
                        continue; // Skip to the next iteration of the loop
                    }
            ?>
                    <div class="info-card">
                        <h3 class="info-card-title">
                            <a href="job_details.php?id=<?= $job_id ?>"><?= $job_title ?></a>

                            <div class="info-card-category-label">
                                <span class="category-badge"><?= $category_name_display ?></span>
                            </div>

                        </h3>
                        <!-- New design: Highlight category name as a label/badge -->
                        
                        <!-- rich_text_description snippet removed as per new design request -->
                        <div class="info-card-link">
                            <a href="job_details.php?id=<?= $job_id ?>">View Details & Apply <i class="fas fa-arrow-right ms-1"></i> &raquo;</a>
                        </div>
                    </div>
            <?php
                endwhile;
            } else {
                // Message displayed if no active posts are found at all
                echo "<p class='text-center text-muted col-span-full'>No recent updates available at the moment.</p>";
            }
            // Free the result set for recent updates
            mysqli_free_result($recent_updates_result);
            ?>
        </div>
    </main>
</div>

<!-- CSS Styles for the New Category Label -->
<style>
    /* Ensure these :root variables are defined in your main stylesheet */
    :root {
        --bootstrap-primary-blue: #0d6efd;
        --bootstrap-primary-hover: #0a58ca;
        --bootstrap-text-dark: #212529;
        --bootstrap-medium-gray: #e9ecef;
        --text-dark: #333333; /* General dark text color */
        --font-family-base: 'Inter', sans-serif;
        --transition-duration: 0.3s;
    }

    /* New style for the category label container */
    .info-card-category-label {
        margin-top: 15px; /* Space above the label */
        margin-bottom: 15px; /* Space below the label */
        text-align: left; /* Align label to the left */
    }

    /* Style for the category badge itself */
    .category-badge {
        display: inline-block; /* Allows padding and margin */
        background-color: var(--bootstrap-primary-blue); /* Blue background */
        color: var(--bootstrap-text-light); /* White text */
        padding: 6px 12px; /* Padding inside the badge */
        border-radius: 20px; /* Pill shape */
        font-size: 0.85rem; /* Smaller, readable font size */
        font-weight: 600; /* Semi-bold text */
        text-transform: uppercase; /* Uppercase for a label look */
        letter-spacing: 0.5px;
        transition: background-color var(--transition-duration) ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        
    }
    /* Adjustments for existing info-card elements due to new layout */
    .info-card-meta {
        /* If only date is left, you might want to adjust its margin-bottom */
        margin-bottom: 10px; /* Reduced margin since description is gone */
    }

    /* Ensure the info-card-link is still at the bottom */
    .info-card-link {
        margin-top: auto; /* Pushes the link to the bottom */
        padding-top: 10px; /* Add some padding above the link */
    }

    /* Responsive adjustments for the new category label */
    @media (max-width: 768px) {
        .category-badge {
            font-size: 0.8rem;
            padding: 5px 10px;
        }
    }
    @media (max-width: 480px) {
        .category-badge {
            font-size: 0.75rem;
            padding: 4px 8px;
        }
    }
</style>
    <?php include 'Footer.php'; ?>

    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>


    <script>
        // Current Year
        document.getElementById('currentYear').textContent = new Date().getFullYear();

          window.addEventListener("load", function () {
    setTimeout(() => {
      const loader = document.getElementById("refresh-loader");
      loader.style.opacity = "0";
      setTimeout(() => loader.style.display = "none", 500);
    }, 300); // Spinner stays for 300ms minimum
  });
    </script>
<?php include 'hide_page_url.php'; ?>
<?php include 'track_visitor.php'; ?>
</body>
</html>