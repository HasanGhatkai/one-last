<?php include 'hide_page_url.php'; ?>
<?php include 'track_visitor.php'; ?>
<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "star cyber cafe";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Log the error (useful for debugging on the server)
    error_log("Database connection failed: " . $conn->connect_error);
    // Display a user-friendly message and stop execution
    die("Connection failed: Please try again later.");
}

// Fetch images from the 'gallery' table, ordered by upload date (most recent first)
$sql = "SELECT image_filename, description FROM gallery ORDER BY upload_date DESC";
$result = $conn->query($sql);

$images = []; // Initialize an empty array to hold image data
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Construct the full image path.
        // IMPORTANT: This path must be the web-accessible path from your domain's root.
        $imagePath = "admin/dashboard/uploads/" . htmlspecialchars($row["image_filename"]);
        
        // Add the image data to our array
        $images[] = [
            'src' => $imagePath,
            'description' => htmlspecialchars($row["description"])
        ];
    }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About Star Cyber Cafe</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* General Body and Section Styling */
        body {
            font-family: 'Poppins', sans-serif; /* Changed font */
            background-color: #f8f9fa;
            line-height: 1.7; /* Increased line height for readability */
            color: #333;
        }

        section {
            padding: 100px 0; /* More vertical padding */
            position: relative;
            overflow: hidden;
        }

        /* Hero Section - New addition */
        .hero-section {
            background: linear-gradient(rgba(0, 30, 87, 0.7), rgba(0, 30, 87, 0.7)), url('data_from_drive/WEBSITE/STAR CYBER CAFE BENNER/nikhil/star2.jpg') center center no-repeat; /* Example background image */
            background-size: cover;
            color: #fff;
            padding: 120px 0;
            text-align: center;
        }
        .hero-section h1 {
            font-size: 3.5em;
            font-weight: 700;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        .hero-section p {
            font-size: 1.2em;
            max-width: 800px;
            margin: 0 auto 30px auto;
            opacity: 0.9;
        }

        /* Section Title Styling */
        .sec-title {
            text-align: left;
            margin-bottom: 50px; /* Increased margin */
        }

        .sec-title.text-center {
            text-align: center;
        }

        .sec-title .title {
            font-size: 1.1em; /* Slightly larger */
            color: #007bff;
            font-weight: 600;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 2px; /* More letter spacing */
            display: block; /* Ensures it takes full line */
        }

        .sec-title h2 {
            font-size: 3em; /* Larger heading */
            font-weight: 700;
            position: relative;
            padding-bottom: 15px;
            color: #001e57;
            line-height: 1.3;
        }

        .sec-title h2::before {
            content: '';
            width: 80px; /* Wider underline */
            height: 5px; /* Thicker underline */
            background: #007bff;
            position: absolute;
            bottom: 0;
            left: 0;
            border-radius: 5px; /* Rounded ends */
        }

        .sec-title.text-center h2::before {
            left: 50%;
            transform: translateX(-50%);
        }

        /* Text and List Styling */
        .text {
            font-size: 1.05em; /* Slightly larger text */
            color: #495057;
            margin-bottom: 30px;
            line-height: 1.8; /* Increased line height */
        }

        .list-style-one {
            list-style: none;
            padding-left: 0;
            margin-bottom: 30px;
        }

        .list-style-one li {
            position: relative;
            padding-left: 40px; /* More padding for icon */
            margin-bottom: 15px; /* More space between items */
            font-size: 1.05em;
            color: #343a40;
            transition: color 0.3s ease, transform 0.3s ease; /* Added transform transition */
        }

        .list-style-one li:hover {
            color: #007bff;
            transform: translateX(5px); /* Slight movement on hover */
        }

        .list-style-one li::before {
            content: "\f058"; /* Default checkmark */
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            left: 0;
            top: 2px;
            color: #28a745; /* Green checkmark */
            font-size: 1.2em; /* Slightly larger icon */
        }

        

        /* Button Styling */
        .btn-style-one {
            padding: 15px 40px; /* Larger padding */
            background: #007bff;
            color: #fff;
            font-weight: 600;
            border: none;
            text-decoration: none;
            transition: all 0.4s ease; /* Slower transition */
            border-radius: 50px; /* Pill shape */
            display: inline-block;
            margin-top: 20px; /* More margin */
            box-shadow: 0 6px 20px rgba(0, 123, 255, 0.3); /* Stronger initial shadow */
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-style-one:hover {
            background: #0056b3;
            transform: translateY(-5px); /* More lift */
            box-shadow: 0 12px 30px rgba(0, 123, 255, 0.5); /* Stronger shadow on hover */
            color: #fff;
        }

        /* Image Column Styling in About Section */
        .about-section .image-column {
            position: relative; /* For potential layering effects */
        }
        .image-column img {
            border-radius: 12px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2); /* Stronger shadow */
            transition: transform 0.5s ease, box-shadow 0.5s ease;
        }

        .image-column img:hover {
            transform: scale(1.03); /* Slightly more zoom */
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
        }

        /* GALLERY SECTION SPECIFIC CSS */
        .image-gallery-section .image-item {
            margin-bottom: 30px;
            border-radius: 15px; /* More rounded corners */
            overflow: hidden;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1); /* Stronger shadow */
            background: #fff;
            transition: transform 0.4s ease, box-shadow 0.4s ease, background-color 0.3s ease;
            cursor: pointer; /* Indicate that it's clickable */
        }

        .image-gallery-section .image-item:hover {
            transform: translateY(-10px); /* More lift */
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.18); /* Stronger shadow on hover */
            background-color: #f0f8ff; /* Subtle background change on hover */
        }

        .image-gallery-section .image-item img {
            width: 100%;
            height: 250px; 
            object-fit: cover;
            display: block;
            transition: transform 0.4s ease;
        }
        
        .image-gallery-section .image-item img:hover {
            transform: scale(1.08); /* More zoom on hover */
        }

        .image-gallery-section .image-item .description {
            padding: 20px; /* More padding */
            text-align: center;
            background-color: #e9f5ff;
            border-top: 1px solid #d0e8ff;
            font-size: 1em; /* Slightly larger font */
            color: #4a627d;
            font-weight: 500;
            min-height: 70px; /* Ensure consistent height for description area */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image-gallery-section .image-item .description:hover {
            color: #0056b3; /* Darker blue on hover */
        }
        /* END GALLERY SECTION CSS */

        /* CUSTOM MODAL STYLES */
        .custom-modal-overlay {
            display: none; /* IMPORTANT: Hidden by default to prevent showing on refresh */
            position: fixed; 
            z-index: 1050; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgba(0,0,0,0.85); /* Darker overlay */
            /* We will apply display: flex via JavaScript when the modal opens */
            justify-content: center; 
            align-items: center; 
            padding: 20px; 
        }

        .custom-modal-content {
            background-color: #fff; /* White background */
            margin: auto;
            padding: 25px; /* Padding for the image container */
            border-radius: 12px; /* Rounded corners */
            box-shadow: 0 10px 30px rgba(0,0,0,0.7); /* Stronger shadow */
            max-width: 90%; 
            max-height: 90%; 
            position: relative;
            animation: fadeIn 0.3s ease-out; /* Fade in animation */
            display: flex; /* Use flexbox for image centering within content */
            justify-content: center;
            align-items: center;
        }

        .custom-modal-content img {
            display: block; 
            max-width: 100%; 
            max-height: 80vh; /* Max height relative to viewport height */
            height: auto; /* Maintain aspect ratio */
            border-radius: 8px; /* Rounded image corners inside modal */
        }

        .custom-modal-close {
            color: #eee; /* Lighter close button color */
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 40px; /* Larger close button */
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5); /* Shadow for visibility */
        }

        .custom-modal-close:hover,
        .custom-modal-close:focus {
            color: #fff; /* White on hover */
            text-decoration: none;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        /* Responsive adjustments */
        @media (max-width: 991px) {
            .hero-section h1 {
                font-size: 2.5em;
            }
            .hero-section p {
                font-size: 1em;
            }
            .about-section .image-column {
                margin-top: 50px;
            }
            .sec-title h2 {
                font-size: 2.2em;
            }
        }
        @media (max-width: 767px) {
            section {
                padding: 60px 0;
            }
            .hero-section {
                padding: 80px 0;
            }
            .hero-section h1 {
                font-size: 2em;
            }
            .sec-title h2 {
                font-size: 1.8em;
            }
            .sec-title h2::before {
                width: 50px;
            }
            .list-style-one li {
                font-size: 0.95em;
                padding-left: 30px;
            }
            .image-gallery-section .image-item img {
                 height: 200px;
            }
            .custom-modal-content {
                padding: 15px;
            }
            .custom-modal-content img {
                max-height: 70vh;
            }
            .custom-modal-close {
                font-size: 30px;
                right: 15px;
                top: 5px;
            }
        }
    </style>
</head>
<body>

<?php include 'Header.php'; // Include your Header.php file ?>

<section class="about-section" id="about-section-scroll">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="inner-column">
                    <div class="sec-title">
                        <span class="title">Our Introduction</span>
                        <h2>Welcome to Star Cyber Cafe</h2>
                    </div>
                    <div class="text">
                        Located at <B>Yash Complex, Nr. Jalaram Chowk, Gita Mandir Road, Bhakti Nagar Circle, Rajkot, Star Cyber Cafe</b> is your trusted digital service center offering **High Speed Internet** and a wide range of government and document-related services. We are committed to fast, accurate, and friendly service to make your online tasks easier.
                    </div>
                    <ul class="list-style-one">
                        <li class="online-forms">📄 ઑનલાઇન ફોર્મ (Online Forms)</li>
                        <li class="passport">🛂 પાસપોર્ટ (Passport)</li>
                        <li class="pan-card">🆔 પાનકાર્ડ (PAN Card)</li>
                        <li class="udyog-aadhaar">🧾 ઉદ્યોગ આધાર (Udyog Aadhaar)</li>
                        <li class="food-license">🍽️ ફૂડ લાઈસન્સ (Food License)</li>
                        <li class="driving-license">🚗 ડ્રાઈવિંગ લાઈસન્સ (Driving License)</li>
                        <li class="scholarship">🎓 સ્કોલરશીપ (Scholarship)</li>
                        <li class="govt-assistance">🏛️ સરકારી સહાય (Government Assistance)</li>
                        <li class="aadhaar">🧾 આધારકાર્ડ (Aadhaar Card)</li>
                        <li class="pvc-card">💳 PVC કાર્ડ (PVC Card)</li>
                        <li class="printing">🖨️ પ્રિન્ટીંગ (Printing)</li>
                        <li class="scanning">📠 સ્કેનિંગ (Scanning)</li>
                    </ul>
                    <div class="text">
                        <b>Contact:</b> Nileshbhai – 📞 8000 777 102
                        <br><b>Email:</b> 📧 cafe.star92@gmail.com
                    </div>
                    <a href="#" class="btn-style-one" data-bs-toggle="modal" data-bs-target="#vstmdl">Discover More</a>
                </div>
            </div>
            <div class="col-lg-6 image-column">
                <img src="data_from_drive/WEBSITE/STAR CYBER CAFE BENNER/nikhil/star2.jpg" alt="Our Story" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<section class="image-gallery-section bg-light"> <div class="container">
        <div class="sec-title text-center">
            <span class="title">Our Services</span>
            <h2>Image Gallery</h2>
        </div>
        <div class="row" id="gallery-container">
            <?php
            // Check if there are images to display
            if (!empty($images)) {
                foreach ($images as $image) {
                    echo '
                    <div class="col-md-4 col-sm-6">
                        <div class="image-item">
                            <img src="' . $image['src'] . '" alt="' . $image['description'] . '" class="img-fluid gallery-thumbnail" onerror="this.onerror=null;this.src=\'https://via.placeholder.com/400x300?text=Image+Not+Found\';" data-full-src="' . $image['src'] . '" data-description="' . $image['description'] . '">
                            <p class="description">' . $image['description'] . '</p>
                        </div>
                    </div>
                    ';
                }
            } else {
                echo '<div class="col-12 text-center"><p>No gallery images found yet. Please check back soon!</p></div>';
            }
            ?>
        </div>
    </div>
</section>

<div id="imageModal" class="custom-modal-overlay">
    <div class="custom-modal-content">
        <span class="custom-modal-close">&times;</span>
        <img id="modalImage" src="" alt="Full Image">
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageModal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    // Removed modalTitle as we don't want to display description in the popup
    const closeModal = document.querySelector('.custom-modal-close');
    const galleryThumbnails = document.querySelectorAll('.gallery-thumbnail');

    // Smooth scroll for hero button
    const heroScrollBtn = document.querySelector('.hero-section .btn');
    if (heroScrollBtn) {
        heroScrollBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            document.querySelector(targetId).scrollIntoView({
                behavior: 'smooth'
            });
        });
    }

    // Open the modal when a gallery thumbnail is clicked
    galleryThumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
            const fullSrc = this.getAttribute('data-full-src');
            // Removed getting description, as it's not used in the modal anymore
            if (fullSrc) {
                modalImage.src = fullSrc;
                // Removed setting modalTitle content
                imageModal.style.display = 'flex'; // Show modal using flex for centering
                document.body.style.overflow = 'hidden'; // Prevent scrolling background
            }
        });
    });

    // Function to close the modal
    function closeImageModal() {
        imageModal.style.display = 'none';
        document.body.style.overflow = ''; // Restore scrolling
    }

    // Close the modal when the close button is clicked
    closeModal.addEventListener('click', closeImageModal);

    // Close the modal when clicking anywhere on the overlay
    imageModal.addEventListener('click', function(event) {
        if (event.target === imageModal) {
            closeImageModal();
        }
    });

    // Close the modal with the Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && imageModal.style.display === 'flex') {
            closeImageModal();
        }
    });
});
</script>
<?php include 'footer.php'; ?>
</body>
</html>
