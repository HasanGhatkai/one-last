<?php
// Step 1: Connect to the database
include "admin/database/config.php";

// Step 2: Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM posts ORDER BY id DESC LIMIT 20";
$result = $conn->query($sql);

$headlines_html = "";

if ($result->num_rows > 0) {
    $count = 0;
    $total = $result->num_rows;

    while ($row = $result->fetch_assoc()) {
        $link = "job_details.php?id=" . urlencode($row["id"]);
        $title = htmlspecialchars($row["title"]);

        $headlines_html .= "<a href=\"$link\" class=\"marquee-link-item\">$title</a>";

        // Add separator only if it's not the last item
        if (++$count < $total) {
            $headlines_html .= " &nbsp; &nbsp; <i class=\"fas fa-circle text-primary\" style=\"font-size: 0.5em; vertical-align: middle;\"></i> &nbsp; &nbsp; ";
        }
    }
} else {
    $headlines_html = "<span class=\"marquee-link-item\">No latest job updates available at the moment. Please check back later!</span>";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="image/cropped_circle_image.png" type="image/x-icon" />

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Modern Sarkari Job Portal for latest government job updates, results, admit cards, and syllabus in India.">
    <meta name="keywords" content="Sarkari Result, Sarkari Job, Government Jobs, Modern Job Portal, Latest Jobs, Admit Card, Syllabus, Answer Key">

    <title>Star Cyber Cafe - Modern Sarkari Job Portal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" />

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Lato:wght@400;700&display=swap" rel="stylesheet">

    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>


    <style>
    :root {
        /* Bootstrap Primary Blue and related shades */
        --primary-blue: #0d6efd; /* Standard Bootstrap Primary Blue */
        --primary-hover: #0a58ca; /* Darker blue for hover states, similar to Bootstrap's btn-primary:hover */
        --secondary-dark: #212529; /* Darker charcoal for main elements, close to Bootstrap's --bs-dark */
        --light-gray: #f8f9fa; /* Lightest gray, similar to Bootstrap's --bs-light */
        --medium-gray: #e9ecef; /* Slightly darker gray for subtle backgrounds/borders */
        --text-dark: #212529; /* Standard dark text */
        --text-light: #ffffff; /* White text for dark backgrounds */
        --border-color: rgba(0, 0, 0, 0.125); /* Subtle border for light themes */
        --shadow-subtle: rgba(0, 0, 0, 0.075); /* Very light shadow */
        --shadow-medium: rgba(0, 0, 0, 0.175); /* Medium shadow */
        --transition-duration: 0.3s; /* Global transition speed */

        /* Typography */
        --font-family-base: 'Inter', sans-serif; /* Adjusted to a common sans-serif like Inter */
        --font-family-heading: 'Poppins', sans-serif; /* Adjusted to a common sans-serif like Poppins */

        /* Header Specific */
        --header-bg: var(--primary-blue); /* Header background set to primary blue */
        --header-logo-color: var(--text-light); /* White logo text on blue background */
        --header-contact-text: rgba(255, 255, 255, 0.8); /* Slightly transparent white for contact info */
        --header-border-bottom: var(--primary-hover); /* A slightly darker blue for the border */

        /* Navigation Specific */
        --nav-bg: var(--secondary-dark); /* Dark charcoal for nav background */
        --nav-link-color: rgba(255, 255, 255, 0.75); /* Lighter white for nav links */
        --nav-link-hover-color: var(--text-light); /* Pure white on hover */
        --nav-link-active-border: var(--primary-blue); /* Primary blue for active/hover underline */

        /* Marquee Specific */
        --marquee-bg-color: var(--medium-gray); /* Medium gray for marquee background */
        --marquee-text-color: var(--text-dark); /* Dark text for legibility */
        --marquee-link-hover-color: var(--primary-blue); /* Primary blue for marquee link hover */
        --marquee-speed: 20s; /* Default speed, adjust if needed */
        --marquee-height: 45px; /* Default height, adjust if needed */
        --marquee-font-size: 0.95rem; /* Default font size, adjust if needed */
        --marquee-padding: 0 20px; /* Default padding, adjust if needed */
    }

    body {
        margin: 0;
        font-family: var(--font-family-base);
        /* Keeping this body animation as requested */
        background: linear-gradient(135deg, #e0f7fa, #ffffff, #fce4ec);
        background-size: 400% 400%;
        animation: gradientShift 15s ease infinite;
        color: var(--text-dark); /* Default text color for body */
        line-height: 1.6;
        text-rendering: optimizeLegibility;
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* --- Header Styling --- */
    .site-header {
        position: sticky;
        top: 0;
        z-index: 1050;
        background-color: var(--header-bg); /* Now uses primary blue */
        box-shadow: 0 4px 15px var(--shadow-medium); /* Adjusted shadow */
        padding: 1.2rem 2.5rem; /* Slightly adjusted padding */
        border-bottom: 3px solid var(--header-border-bottom); /* Darker blue border */
        color: var(--text-light); /* Light text on blue header */
    }

    .logo-area {
        color: var(--header-logo-color) !important;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 10px; /* Adjusted gap */
        transition: transform var(--transition-duration) ease;
    }

    .logo-area:hover {
        transform: translateY(-3px); /* Slightly less pronounced lift */
        text-decoration: none;
        opacity: 0.95;
    }

    .logo-area img {
        width: 50px; /* Adjusted logo size */
        height: 50px;
        object-fit: contain;
    }

    .logo-area span {
        font-family: var(--font-family-heading);
        font-weight: 700; /* Adjusted weight */
        font-size: 2.2rem; /* Adjusted size */
        letter-spacing: -0.7px; /* Adjusted letter spacing */
        color: var(--text-light); /* White text for contrast on dark background */
    }

    .site-header small.text-muted {
        color: var(--header-contact-text) !important;
        font-size: 0.88rem; /* Slightly smaller */
    }

    .site-header .btn-outline-primary {
        border: 2px solid var(--text-light); /* White border for call-to-action on blue header */
        color: var(--text-light); /* White text */
        background-color: transparent;
        font-weight: 600; /* Adjusted weight */
        padding: 0.6rem 1.5rem; /* Adjusted padding */
        border-radius: 30px; /* Slightly less rounded */
        transition: all var(--transition-duration) ease-in-out;
        text-transform: uppercase;
        letter-spacing: 0.3px; /* Adjusted letter spacing */
    }

    .site-header .btn-outline-primary:hover {
        background-color: var(--text-light); /* White background on hover */
        color: var(--primary-blue); /* Primary blue text on white hover */
        box-shadow: 0 4px 12px rgba(255, 255, 255, 0.3); /* White glow */
        transform: translateY(-2px);
    }

    /* --- Navigation Bar Styling --- */
    .main-navigation.navbar {
        background-color: var(--nav-bg); /* Dark charcoal for nav */
        box-shadow: 0 3px 15px var(--shadow-medium);
        padding: 0.7rem 0;
        border-bottom: 4px solid var(--primary-blue); /* Primary blue accent line */
    }

    .main-navigation .navbar-brand {
        font-family: var(--font-family-heading);
        font-weight: 600;
        font-size: 1.5rem;
        color: var(--text-light) !important;
    }

    .main-navigation .navbar-nav .nav-item {
        margin: 0 15px; /* Adjusted spacing */
    }

    .main-navigation .navbar-nav .nav-link {
        color: var(--nav-link-color);
        padding: 12px 25px; /* Adjusted padding */
        font-weight: 500; /* Adjusted weight */
        font-size: 1rem;
        border-radius: 5px; /* Adjusted rounding */
        transition: all var(--transition-duration) ease;
        position: relative;
        overflow: hidden;
        display: block;
        text-transform: uppercase;
        letter-spacing: 0.8px; /* Adjusted letter spacing */
    }

    /* Animated underline for nav links */
    .main-navigation .navbar-nav .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2.5px; /* Adjusted thickness */
        background-color: var(--nav-link-active-border); /* Primary blue underline */
        transform: scaleX(0);
        transform-origin: bottom right;
        transition: transform var(--transition-duration) ease-out;
    }

    .main-navigation .navbar-nav .nav-link:hover::after,
    .main-navigation .navbar-nav .nav-link.active::after {
        transform: scaleX(1);
        transform-origin: bottom left;
    }

    .main-navigation .navbar-nav .nav-link:hover,
    .main-navigation .navbar-nav .nav-link.active {
        background-color: rgba(255, 255, 255, 0.1); /* Subtle white transparency */
        color: var(--nav-link-hover-color) !important;
        transform: translateY(-1px);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
        text-decoration: none;
    }

    .navbar-toggler {
        border: none;
        outline: none;
        padding: 0.7rem 1rem;
        background-color: rgba(255, 255, 255, 0.15);
        border-radius: 6px;
        transition: background-color var(--transition-duration) ease;
    }
    .navbar-toggler:hover {
        background-color: rgba(255, 255, 255, 0.25);
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    /* --- Marquee Styling (NO CHANGES HERE per request, using current definitions) --- */
   .marquee-container {
    background-color: #f0f2f5;
    padding: 8px 0;
    overflow: hidden;
    white-space: nowrap;
    border-radius: 10px;
    margin: 25px auto;
    max-width: 90%;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    display: flex;
    align-items: center;
    height: 45px;
    font-size: 0.95rem;
    color: #343a40;
    opacity: 1;
    transition: none;
    position: relative;
}

.marquee-link-item {
    text-decoration: none;
    color: #223447;
    font-weight: 600;
    transition: color 0.2s ease;
    white-space: nowrap;
    padding: 0 5px;
}


.marquee-link-item:hover {
    color: #17a2b8;
    text-decoration: underline;
}

.marquee-content {
    display: inline-block;
    padding: 0 20px;
    animation: marquee-scroll 60s linear infinite; /* Increased from 28s to 60s */
    animation-delay: -30s;
    will-change: transform;
}

@keyframes marquee-scroll {
    0% { transform: translateX(100%); }
    100% { transform: translateX(-100%); }
}



    /* --- Modal Styling --- */
    .modal-content {
        border-radius: 1.5rem !important; /* Very rounded modals */
        overflow: hidden;
        border: none;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3); /* Deepest modal shadow */
    }

    .modal-header {
        padding: 2rem 2.5rem;
        border-bottom: none !important;
    }

    .modal-header.bg-warning {
        background-color: #ffc107 !important; /* Yellow warning (unchanged as primary blue not relevant here) */
        color: var(--text-dark) !important;
    }

    .modal-header.bg-dark {
        background-color: var(--secondary-dark) !important; /* Dark blue header for consistency */
        color: var(--text-light) !important;
    }

    .modal-title {
        font-family: var(--font-family-heading);
        font-weight: 800;
        font-size: 2rem; /* Larger titles */
        color: inherit;
    }

    .btn-close {
        filter: brightness(0.8) invert(1);
        transition: transform 0.2s ease, opacity 0.2s ease;
        font-size: 1.4rem; /* Larger close button */
    }
    .btn-close:hover {
        transform: rotate(180deg) scale(1.2); /* Full spin and grow */
        opacity: 1;
    }
    .btn-close-white {
        filter: brightness(0) invert(1);
    }

    .modal-body {
        padding: 3rem; /* Very generous padding */
        font-size: 1.1rem;
        color: var(--text-dark);
        line-height: 1.7;
    }

    .modal-body strong {
        color: var(--primary-blue); /* Uses primary blue */
        font-weight: 700;
    }

    .modal-body .row div {
        padding: 0.7rem 0.75rem;
        font-size: 1rem;
        display: flex;
        align-items: center;
    }
    .modal-body .row i {
        margin-right: 1.2rem;
        font-size: 1.4rem;
        min-width: 35px;
        text-align: center;
        color: var(--primary-blue); /* Icons in primary blue */
    }

    .modal-footer {
        padding: 2rem 3rem;
        border-top: none !important;
        background-color: var(--medium-gray); /* Adjusted to medium gray */
    }

    .modal-footer .btn {
        border-radius: 3rem !important; /* Super rounded */
        padding: 1rem 3rem !important;
        font-weight: 700;
        font-size: 1.15rem;
        transition: all var(--transition-duration) ease-in-out;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .modal-footer .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        color: var(--text-light);
    }
    .modal-footer .btn-dark {
        background-color: var(--secondary-dark); /* Dark charcoal button */
        border-color: var(--secondary-dark);
        color: var(--text-light);
    }
    .modal-footer .btn-dark:hover {
        background-color: var(--primary-blue); /* Primary blue on hover */
        border-color: var(--primary-blue);
        box-shadow: 0 6px 18px rgba(13, 110, 253, 0.4); /* Primary blue glow */
        color: var(--text-light); /* White text on hover */
    }

    .wobble-wrench {
        animation: wobble 1.5s ease-in-out infinite;
        display: inline-block;
    }

    @keyframes wobble {
        0%, 100% { transform: rotate(0deg); }
        15% { transform: rotate(-10deg); }
        30% { transform: rotate(10deg); }
        45% { transform: rotate(-10deg); }
        60% { transform: rotate(5deg); }
        75% { transform: rotate(-5deg); }
        90% { transform: rotate(0deg); }
    }


    /* --- Media Queries for Responsiveness --- */
    @media (max-width: 991.98px) {
        .site-header {
            padding: 1rem 1.5rem; /* Adjusted for smaller screens */
        }
        .site-header .d-flex {
            flex-direction: column;
            align-items: center;
            gap: 12px; /* Adjusted gap */
        }
        .logo-area span {
            font-size: 1.8rem; /* Adjusted for smaller screens */
        }
        .site-header .btn {
            width: auto;
            justify-content: center;
            margin-top: 0.5rem;
            flex-grow: 1;
        }
        .site-header .d-flex.flex-wrap {
            width: 100%;
            justify-content: center !important;
        }
        .main-navigation .navbar-nav .nav-item {
            margin: 5px 0;
        }
        .main-navigation .navbar-nav .nav-link {
            padding: 10px 20px;
            font-size: 0.95rem;
        }
        .marquee-container {
            max-width: 95%;
            height: 40px; /* Adjusted for smaller screens */
            font-size: 0.9rem;
        }
        .marquee-link-item { /* Changed from .marquee-link */
            font-size: 0.9rem;
            padding: 0 15px;
        }
    }

    @media (max-width: 767.98px) {
        .site-header {
            padding: 0.8rem 1rem;
        }
        .logo-area img {
            width: 40px;
            height: 40px;
        }
        .logo-area span {
            font-size: 1.6rem;
        }
        .marquee-container {
            font-size: 0.85rem;
            height: 35px;
            margin: 20px auto;
        }
        .marquee-link-item { /* Changed from .marquee-link */
            font-size: 0.85rem;
            padding: 0 10px;
        }
        .modal-body {
            padding: 1.5rem;
            font-size: 0.9rem;
        }
        .modal-footer .btn {
            padding: 0.7rem 1.8rem !important;
            font-size: 0.95rem;
        }
    }

    @media (max-width: 575.98px) {
        .site-header {
            padding: 0.6rem;
        }
        .logo-area span {
            font-size: 1.4rem;
        }
        .site-header .d-none.d-md-block {
            display: none !important;
        }
        .site-header .btn {
            flex-grow: unset;
        }
        .marquee-container {
            font-size: 0.8rem;
            height: 30px;
        }
        .marquee-link-item { /* Changed from .marquee-link */
            font-size: 0.8rem;
            padding: 0 8px;
        }
        :root {
            --marquee-speed: 2s;
        }
    }
    
</style>
</head>
<body>
<!-- Updated "Developed by" Section with Integrated Styles -->
<div class="developed-by-section">
    Developed by 
    <a href="https://balajienterprise.in" target="_blank" class="animated-text-link">
        Balaji Enterprise
    </a>
</div>

<style>
    /*
    CSS for the "Developed by" section.
    These variables are duplicated here to make this section self-contained.
    Ensure they match your main stylesheet's definitions for consistency.
    */
    :root {
        --bootstrap-primary-blue: #0d6efd; /* Standard Bootstrap Primary Blue */
        --bootstrap-primary-hover: #0a58ca; /* Darker blue for hover states */
        --bootstrap-text-light: #ffffff; /* White text for dark backgrounds */
        --secondary-dark: #212529; /* Darker charcoal from your existing theme */
        --transition-duration: 0.3s; /* Global transition speed */
    }

    /* Styles for the entire "Developed by" footer bar */
    .developed-by-section {
        background-color: var(--secondary-dark); /* Dark charcoal background */
        color: rgba(255, 255, 255, 0.8); /* Slightly muted white text */
        padding: 0.1rem 1rem; /* Generous padding */
        text-align: center;
        font-weight: 500; /* Medium font weight */
        font-size: 0.95rem; /* Readable font size */
        /* REMOVED: border-top: 3px solid var(--bootstrap-primary-blue); */ /* This line was removed */
        box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.2); /* Subtle upward shadow */
        width: 100%; /* Ensure it spans full width */
        box-sizing: border-box; /* Include padding/border in width */
    }

    /* Styles for the animated text link */
    .animated-text-link {
        text-decoration: none;
        font-weight: 700; /* Bolder for emphasis */
        transition: color var(--transition-duration) ease; /* Smooth transition for direct hover */
        /* Animation properties */
        animation: color-change 3s infinite alternate; /* 5s duration, infinite, alternates direction */
        display: inline-block; /* Required for transform effects and proper animation */
        padding: 0 5px; /* Small padding around the text */
    }

    .animated-text-link:hover {
        color: var(--bootstrap-primary-blue); /* Ensure it's blue on hover */
        text-decoration: underline; /* Underline on hover */
        animation-play-state: paused; /* Pause animation on hover for readability */
    }

    

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .developed-by-section {
            padding: 1rem 0.8rem;
            font-size: 0.9rem;
        }
        .animated-text-link {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 480px) {
        .developed-by-section {
            padding: 0.8rem 0.5rem;
            font-size: 0.8rem;
        }
        .animated-text-link {
            font-size: 0.8rem;
        }
    }
</style>

<header class="site-header container-fluid animate__animated animate__fadeInDown">
    <div class="d-flex flex-column flex-lg-row align-items-center justify-content-between gap-3">

        <a href="index.php" class="logo-area">
            <img src="image/cropped_circle_image.png" alt="Star Cyber Cafe Logo">
            <span>Star Cyber Cafe</span>
        </a>

        <div class="d-flex flex-wrap align-items-center justify-content-end gap-3 text-end">

            <div class="d-none d-md-block">
                <small class="text-muted">Need help? Call us:</small>
            </div>

            <a href="tel:+918000777102" class="btn btn-outline-primary d-flex align-items-center">
                <i class="fas fa-phone-alt me-2"></i>+91 80007 77102
            </a>

            <div class="d-none d-md-block">
                <small class="text-muted">Email us:</small>
            </div>

            <a href="mailto:cafe.star92@gmail.com" class="btn btn-outline-primary d-flex align-items-center">
                <i class="fas fa-envelope me-2"></i> cafe.star92@gmail.com
            </a>

        </div>
    </div>
</header>

<nav class="main-navigation navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container-fluid px-md-5">
        <a class="navbar-brand d-lg-none" href="index.php">
            <i class="fas fa-star text-warning me-2"></i> Star Cyber Cafe
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavMenu" aria-controls="mainNavMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span><i class="fas fa-bars fs-4 text-light"></i></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="mainNavMenu">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" href="index.php">HOME</a></li>
                <li class="nav-item"><a class="nav-link active" href="vacancies_listing_page.php">VIEW ALL UPDATE</a></li>
                <li class="nav-item"><a class="nav-link active" href="about_us.php">ABOUT US</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="marquee-container">
    <marquee behavior="scroll" direction="left" scrollamount="0">
        <div class="marquee-content">
            <?php echo $headlines_html; // This now contains the full <a> tags with links ?>
        </div>
    </marquee>
</div>

<script>
  // BAD: causes delay
setTimeout(function () {
  document.querySelector('.marquee-container').innerHTML = fetchedContent;
}, 2000);

</script>

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-warning text-dark rounded-top-4">
                <h5 class="modal-title" id="myModalLabel"><i class="fas fa-tools me-2"></i> Under Construction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body text-center py-4">
                <p class="mb-3">
                    This section is currently under development.<br>
                    We're working hard to bring you something awesome soon!
                </p>
                <i class="fas fa-wrench fa-4x text-warning wobble-wrench"></i>
            </div>

            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Okay, Got It!</button>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="vstmdl" tabindex="-1" aria-labelledby="vstmdlLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-dark text-white rounded-top-4">
                <h5 class="modal-title" id="vstmdlLabel">
                    <i class="fas fa-star me-2 text-warning"></i> Welcome to Star Cyber Cafe
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body text-center py-4">
                <p class="mb-3">
                    Digital Services | Fast Internet | Government Services<br>
                    <strong>Located at Bhakti Nagar Circle, Rajkot</strong>
                </p>

                <div class="row text-start px-4">
                    <div class="col-6 mb-2"><i class="fas fa-keyboard text-primary me-2"></i>Online Form Filling</div>
                    <div class="col-6 mb-2"><i class="fas fa-passport text-danger me-2"></i>Passport</div>
                    <div class="col-6 mb-2"><i class="fas fa-id-card text-info me-2"></i>PAN Card</div>
                    <div class="col-6 mb-2"><i class="fas fa-fingerprint text-success me-2"></i>UIDAI Aadhaar Update</div>
                    <div class="col-6 mb-2"><i class="fas fa-utensils text-warning me-2"></i>Food License</div>
                    <div class="col-6 mb-2"><i class="fas fa-car text-secondary me-2"></i>Driving License</div>
                    <div class="col-6 mb-2"><i class="fas fa-graduation-cap text-primary me-2"></i>Scholarship</div>
                    <div class="col-6 mb-2"><i class="fas fa-hand-holding-usd text-danger me-2"></i>Government Help</div>
                    <div class="col-6 mb-2"><i class="fas fa-id-badge text-info me-2"></i>Aadhaar Card</div>
                    <div class="col-6 mb-2"><i class="fas fa-clone text-warning me-2"></i>PVC Card</div>
                    <div class="col-6 mb-2"><i class="fas fa-print text-success me-2"></i>Printing</div>
                    <div class="col-6 mb-2"><i class="fas fa-copy text-primary me-2"></i>Scanning</div>
                </div>

                <p class="small mt-3">
                    Visit <strong>Star Cyber Cafe</strong> for all your digital & document needs!
                </p>
            </div>

            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">
                    Visit Us Soon!
                </button>
            </div>

        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleHeaderOnResize() {
        const header = document.querySelector(".site-header");
        if (header) {
            header.hidden = window.innerWidth <= 768; // Keep original logic for this specific script.
        }
    }

    window.addEventListener("DOMContentLoaded", toggleHeaderOnResize);
    window.addEventListener("resize", toggleHeaderOnResize);

    // You can uncomment this if you want the "Welcome" modal to show automatically on page load.
    // document.addEventListener('DOMContentLoaded', function() {
    //     var welcomeModal = new bootstrap.Modal(document.getElementById('vstmdl'));
    //     welcomeModal.show();
    // });
</script>

</body>
</html>