<?php include 'track_visitor.php'; ?>
<?php include 'cursor-effect.html'; ?>
<?php
// PHP Error Reporting - REMOVE OR SET TO 0 IN PRODUCTION
ini_set('display_errors', 1);
error_reporting(E_ALL);

// MySQL database connection details
$host = "localhost";
$db = "star cyber cafe";    // Your database name
$user = "root";             // Your database username
$pass = "";                 // Your database password (default is empty in XAMPP)

// Create a new MySQLi connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8");

// Define upload directory - must match the path in your dashboard file
$uploadDir = 'upload_data/'; // Relative path to where files are saved


// Get the job ID from the URL
$job_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$job = null; // Initialize job variable

if ($job_id > 0) {
    // Prepared statement to fetch job details from the 'posts' table
    // Fetching 'file_attachment' instead of 'file_url'
    $stmt = $conn->prepare("SELECT
                                id, category_id, title, vacancy_count, education_required, date_posted,
                                age_between, age_relaxation, application_fee, documents_required,
                                rich_text_description, file_attachment, external_link, status, is_featured
                            FROM posts
                            WHERE id = ? AND status = 'active'");
    $stmt->bind_param("i", $job_id); // 'i' for integer
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $job = $result->fetch_assoc();

        // Fetch associated dynamic dates from 'post_custom_dates' table
        $dates_sql = "SELECT date_type, date_value FROM post_custom_dates WHERE post_id = ?";
        $stmt_dates = $conn->prepare($dates_sql);
        if ($stmt_dates) {
            $stmt_dates->bind_param("i", $job_id);
            $stmt_dates->execute();
            $dates_result = $stmt_dates->get_result();
            $dynamic_dates = [];
            while($date_row = $dates_result->fetch_assoc()) {
                $dynamic_dates[] = $date_row;
            }
            $job['dynamic_dates'] = $dynamic_dates; // Add dynamic dates to the job array
            $stmt_dates->close();
        } else {
            error_log("Failed to prepare statement for fetching dynamic dates in job_details.php: " . $conn->error);
            $job['dynamic_dates'] = []; // Ensure it's an empty array on error
        }
    }
    $stmt->close();
}

$conn->close(); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $job ? htmlspecialchars($job['title']) . ' - Sarkari Job Details' : 'Job Not Found - Sarkari Job Details'; ?></title>
    <meta name="description" content="<?php echo $job ? htmlspecialchars(substr(strip_tags($job['rich_text_description']), 0, 160)) . '...' : 'Details about government jobs and recruitment.'; ?>" />
    <meta name="keywords" content="<?php echo $job ? htmlspecialchars($job['title']) . ', Sarkari Result, Government Job, Apply Online' : 'Sarkari Result, Government Job, Apply Online'; ?>" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <style>
        :root {
            --primary-blue: #007bff;
            --primary-dark-blue: #0056b3;
            --light-blue: #e0f2ff;
            --gray-background: #f8f9fa;
            --dark-gray-text: #343a40;
            --medium-gray-text: #6c757d;
            --border-color: #dee2e6;
            --success-green: #28a745;
            --info-cyan: #17a2b8;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --transition-speed: 0.3s ease;
        }

        body {
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: var(--gray-background);
            color: var(--dark-gray-text);
            line-height: 1.6;
        }

        .marquee-container {
            background: var(--light-blue);
            padding: 10px;
            font-weight: bold;
            font-size: 1rem;
            text-align: center;
            color: var(--primary-dark-blue);
            border-bottom: 1px solid var(--primary-blue);
        }

        .main-content-card {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            margin-top: 25px;
            margin-bottom: 25px; /* Added margin-bottom for spacing between cards */
            box-shadow: var(--box-shadow);
            transition: transform var(--transition-speed);
        }

        .main-content-card:hover {
            transform: translateY(-5px); /* Subtle lift effect on hover */
        }

        .main-title {
            color: var(--primary-dark-blue);
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 20px;
            border-bottom: 2px solid var(--light-blue);
            padding-bottom: 10px;
        }

        .section-title {
            border-left: 6px solid var(--primary-blue);
            padding-left: 15px;
            margin-bottom: 25px;
            color: var(--primary-dark-blue);
            font-size: 1.8rem;
            font-weight: 600;
        }

        .job-meta span {
            display: flex; /* Use flexbox for better icon alignment */
            align-items: center;
            margin-bottom: 10px;
            color: var(--medium-gray-text);
            font-size: 1.05rem;
        }

        .job-meta span i {
            color: var(--primary-blue);
            margin-right: 10px;
            min-width: 20px; /* Ensure icon has enough space */
            text-align: center;
        }

        .brief-info {
            font-style: italic;
            color: var(--medium-gray-text);
            margin-top: 20px;
            padding: 15px;
            background-color: var(--light-blue);
            border-left: 4px solid var(--primary-blue);
            border-radius: 8px;
            font-size: 1.1rem;
        }

        .social-buttons a,
        .btn-action-group a,
        .btn-action-group button,
        .share-buttons-bottom button {
            display: inline-flex; /* Use flex for button content alignment */
            align-items: center;
            justify-content: center;
            margin: 10px 10px 0 0;
            padding: 12px 25px;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            transition: all var(--transition-speed);
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .social-buttons a:hover,
        .btn-action-group a:hover,
        .btn-action-group button:hover,
        .share-buttons-bottom button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }

        /* Specific button styles */
        .btn-primary {
            background-color: var(--primary-blue);
            border-color: var(--primary-blue);
            color: #fff;
        }
        .btn-primary:hover {
            background-color: var(--primary-dark-blue);
            border-color: var(--primary-dark-blue);
        }

        .btn-success {
            background-color: var(--success-green);
            border-color: var(--success-green);
            color: #fff;
        }
        .btn-success:hover {
            background-color: #218838; /* Darker green */
            border-color: #1e7e34;
        }

        .btn-info {
            background-color: var(--info-cyan);
            border-color: var(--info-cyan);
            color: #fff;
        }
        .btn-info:hover {
            background-color: #138496; /* Darker cyan */
            border-color: #117a8b;
        }

        .btn-outline-primary {
            color: var(--primary-blue);
            border-color: var(--primary-blue);
            background-color: transparent;
        }
        .btn-outline-primary:hover {
            background-color: var(--primary-blue);
            color: #fff;
        }


        .btn-action-group {
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .share-buttons-bottom {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
            margin-bottom: 50px;
        }

        /* List styling within cards */
        .main-content-card ul {
            list-style: none;
            padding-left: 0;
            margin-bottom: 20px;
        }

        .main-content-card ul li {
            padding: 8px 0;
            border-bottom: 1px dashed var(--border-color);
            display: flex;
            align-items: center;
            font-size: 1.05rem;
            color: var(--dark-gray-text);
        }

        .main-content-card ul li:last-child {
            border-bottom: none;
        }

        .main-content-card ul li i {
            color: var(--primary-blue);
            margin-right: 10px;
            min-width: 20px;
            text-align: center;
        }

        .main-content-card p {
            margin-bottom: 15px;
            color: var(--dark-gray-text);
            font-size: 1.05rem;
        }

        .main-content-card h5 {
            color: var(--primary-dark-blue);
            font-size: 1.3rem;
            margin-top: 25px;
            margin-bottom: 15px;
        }

        /* Navbar Customization (from Header.php context) */
        .navbar-custom {
            background-color: var(--primary-blue);
            padding: 1rem 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #ffffff;
            font-weight: 600;
            transition: color var(--transition-speed);
        }
        .navbar-custom .nav-link:hover {
            color: #e0e0e0;
        }
        .navbar-toggler {
            border-color: rgba(255,255,255,0.5);
        }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.8%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* PDF Viewer Modal Styles */
        #pdfViewerModal .modal-dialog {
            max-width: 95vw; /* Even wider modal */
            width: 1000px;
            transition: transform var(--transition-speed) ease-out;
        }

        #pdfViewerModal .modal-content {
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.25);
            overflow: hidden; /* Ensures content stays within rounded corners */
        }

        #pdfViewerModal .modal-header {
            background-color: var(--primary-blue);
            color: white;
            border-bottom: none;
            padding: 15px 20px;
        }

        #pdfViewerModal .modal-title {
            font-weight: 600;
        }

        #pdfViewerModal .modal-body {
            padding: 0;
            background-color: #f0f2f5; /* Light background for iframe area */
        }

        #pdfViewerModal iframe {
            width: 100%;
            height: 80vh; /* Taller iframe */
            border: none;
            display: block; /* Remove extra space below iframe */
        }

        #pdfViewerModal .modal-footer {
            justify-content: center;
            background-color: #f8f9fa;
            border-top: 1px solid var(--border-color);
            padding: 15px 20px;
        }

        /* Hide marquee on mobile */
        @media screen and (max-width: 768px) {
            .marquee-container {
                display: none;
            }
            .main-title {
                font-size: 1.8rem;
            }
            .section-title {
                font-size: 1.5rem;
            }
            .main-content-card {
                padding: 20px;
            }
            .social-buttons a,
            .btn-action-group a,
            .btn-action-group button,
            .share-buttons-bottom button {
                width: 100%; /* Make buttons full width on small screens */
                margin-right: 0;
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>
    <?php include 'Header.php'; ?>


<div class="container">
    <?php if ($job) : ?>
        <div class="main-content-card mt-3">
            <h1 class="main-title"><?php echo htmlspecialchars($job['title']); ?> – Apply Online</h1>
            <div class="job-meta">
                <?php if (!empty($job['vacancy_count'])) : ?>
                    <span><i class="fa-solid fa-user-graduate"></i> <strong>Vacancies:</strong> <?php echo htmlspecialchars($job['vacancy_count']); ?></span>
                <?php endif; ?>
            </div>
            <?php if (!empty($job['rich_text_description'])) : // Only show brief info if description exists ?>
            <p class="brief-info">
                <?php echo nl2br(htmlspecialchars(substr(strip_tags($job['rich_text_description']), 0, 200))); ?>...
            </p>
            <?php endif; ?>
        </div>

        <?php if (!empty($job['dynamic_dates'])) : ?>
        <div class="main-content-card">
            <h2 class="section-title">Important Dates</h2>
            <ul>
                <?php foreach ($job['dynamic_dates'] as $date_item) : ?>
                    <li>
                        <i class="fa-solid fa-calendar-check"></i>
                        <strong><?php echo htmlspecialchars($date_item['date_type']); ?>:</strong>
                        <?php echo !empty($date_item['date_value']) ? date('d F Y', strtotime($date_item['date_value'])) : 'N/A'; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <?php if (isset($job['application_fee']) && $job['application_fee'] !== null && $job['application_fee'] !== '') : ?>
        <div class="main-content-card">
            <h2 class="section-title">Application Fee</h2>
            <ul>
                <li><i class="fa-solid fa-rupee-sign"></i> Fee Details: <strong><?php echo htmlspecialchars($job['application_fee']); ?></strong></li>
            </ul>
        </div>
        <?php endif; ?>

        <?php if (!empty($job['age_between']) || !empty($job['age_relaxation'])) : ?>
        <div class="main-content-card">
            <h2 class="section-title">Age Limit</h2>
            <ul>
                <?php if (!empty($job['age_between'])) : ?>
                    <li><i class="fa-solid fa-birthday-cake"></i> Age Between: <strong><?php echo htmlspecialchars($job['age_between']); ?></strong></li>
                <?php else : ?>
                    <li><i class="fa-solid fa-hourglass-start"></i> Age Range: <strong>Not Specified</strong></li>
                <?php endif; ?>
                <?php if (!empty($job['age_relaxation'])) : ?>
                    <li><i class="fa-solid fa-person-breastfeeding"></i> Age Relaxation: <strong><?php echo nl2br(htmlspecialchars($job['age_relaxation'])); ?></strong></li>
                <?php else : ?>
                    <li><i class="fa-solid fa-person-breastfeeding"></i> Age Relaxation: <strong>Not Specified</strong></li>
                <?php endif; ?>
            </ul>
        </div>
        <?php endif; ?>

        <?php if (!empty($job['vacancy_count']) || !empty($job['rich_text_description'])) : // Show if either vacancy count or detailed description exists ?>
        <div class="main-content-card">
            <h2 class="section-title">Vacancy Details</h2>
            <ul>
                <?php if (!empty($job['vacancy_count'])) : ?>
                    <li><i class="fa-solid fa-users"></i> <strong>Total Vacancies:</strong> <?php echo htmlspecialchars($job['vacancy_count']); ?></li>
                <?php else : ?>
                    <li><i class="fa-solid fa-users"></i> <strong>Total Vacancies:</strong> Not Specified</li>
                <?php endif; ?>
            </ul>
            <h5 class="mt-3">Detailed Vacancy Information</h5>
            <?php if (!empty($job['rich_text_description'])) : ?>
                <p><?php echo nl2br(htmlspecialchars($job['rich_text_description'])); ?></p>
            <?php else : ?>
                <p class="text-muted">No detailed description available.</p>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($job['education_required'])) : ?>
        <div class="main-content-card">
            <h2 class="section-title">Eligibility Criteria</h2>
            <ul>
                <li><i class="fa-solid fa-user-check"></i> Educational Qualification:
                    <strong><?php echo nl2br(htmlspecialchars($job['education_required'])); ?></strong>
                </li>
            </ul>
        </div>
        <?php endif; ?>

        <?php if (!empty($job['documents_required'])) : ?>
        <div class="main-content-card">
            <h2 class="section-title">Documents Required</h2>
            <ul>
                <li><i class="fa-solid fa-file-alt"></i> <strong>Required Documents:</strong> <?php echo nl2br(htmlspecialchars($job['documents_required'])); ?></li>
            </ul>
        </div>
        <?php endif; ?>

        <?php if (!empty($job['external_link']) || !empty($job['file_attachment'])) : // Only show action buttons if either PDF or external_link (now WhatsApp) exists ?>
        <div class="btn-action-group text-center">
            <?php if (!empty($job['file_attachment'])) : ?>
                <button type="button" class="btn btn-outline-primary btn-lg" id="viewPdfBtn" data-pdf-url="<?php echo htmlspecialchars($uploadDir . $job['file_attachment']); ?>">
                    <i class="fa fa-file-pdf me-2"></i> View Official Notification
                </button>
            <?php endif; ?>
            <?php if (!empty($job['external_link'])) : // This now acts as the WhatsApp link ?>
                <a href="<?php echo htmlspecialchars($job['external_link']); ?>" target="_blank" class="btn btn-success btn-lg">
                    <i class="fab fa-whatsapp me-2"></i> Join WhatsApp Group
                </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <div class="share-buttons-bottom text-center">
            <button id="genericShareBtn" class="btn btn-info text-white btn-lg">
                <i class="fa-solid fa-share-alt me-2"></i> Share this Job
            </button>
        </div>
        <?php else : ?>
        <div class="alert alert-warning text-center mt-5" role="alert">
            <h4 class="alert-heading">Job Not Found!</h4>
            <p>The job you are looking for does not exist or has been removed.</p>
            <hr>
            <p class="mb-0">Please go back to the <a href="index.php" class="alert-link">homepage</a> or browse other categories.</p>
        </div>
    <?php endif; ?>
</div>

&nbsp;

<div class="modal fade" id="pdfViewerModal" tabindex="-1" aria-labelledby="pdfViewerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl"> <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfViewerModalLabel">Official Notification Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="pdfIframe" src="" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <a id="modalDownloadPdfBtn" href="#" download class="btn btn-primary">
                    <i class="fa fa-download me-2"></i> Download PDF
                </a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
// This script modifies the browser's URL to remove query parameters,
// making it cleaner while retaining the loaded content.
// It's good for SEO and user experience for static-looking pages.
if (history.replaceState) {
    // Construct the base URL without query parameters
    const cleanUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
    // Replace the current history entry with the clean URL
    history.replaceState({path: cleanUrl}, '', cleanUrl);
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // MODIFIED: Share Button Logic
        const genericShareBtn = document.getElementById('genericShareBtn');
        if (genericShareBtn) {
            <?php if ($job) : ?>
                // 1. Prepare the data to be shared
                const jobTitle = `<?php echo htmlspecialchars($job['title']); ?>`;
                let dynamicDatesString = '';
                <?php if (!empty($job['dynamic_dates'])) : ?>
                    <?php foreach ($job['dynamic_dates'] as $date_item) : ?>
                        dynamicDatesString += `*<?php echo htmlspecialchars($date_item['date_type']); ?>:* <?php echo !empty($date_item['date_value']) ? date('d F Y', strtotime($date_item['date_value'])) : 'N/A'; ?>\n`;
                    <?php endforeach; ?>
                <?php endif; ?>

                const shareText = `*${jobTitle}*\n\n` +
                    `*Published:* <?php echo !empty($job['date_posted']) ? date('d F Y', strtotime($job['date_posted'])) : 'N/A'; ?>\n` +
                    dynamicDatesString + '\n' +
                    `*Vacancies:* <?php echo htmlspecialchars($job['vacancy_count'] ?? 'Not Specified'); ?>\n` +
                    `*Education:* <?php echo htmlspecialchars($job['education_required'] ?? 'Not Specified'); ?>\n\n` +
                    `Find more details here:`;
                
                // The full URL to the job posting is needed for sharing
                const shareUrl = '<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/job_details.php?id=' . $job['id']; ?>';

                genericShareBtn.addEventListener('click', async () => {
                    const shareData = {
                        title: jobTitle,
                        text: shareText,
                        url: shareUrl
                    };
                    
                    // 2. Check if the browser supports the Web Share API
                    if (navigator.share) {
                        try {
                            await navigator.share(shareData);
                            console.log('Job shared successfully');
                        } catch (err) {
                            // This error can happen if the user cancels the share dialog
                            console.error('Share error:', err);
                        }
                    } else {
                        // 3. Fallback for browsers that do not support Web Share API
                        try {
                            await navigator.clipboard.writeText(shareUrl);
                            const originalText = genericShareBtn.innerHTML;
                            genericShareBtn.innerHTML = '<i class="fa-solid fa-check me-2"></i> Link Copied!';
                            
                            // Revert button text after 2 seconds
                            setTimeout(() => {
                                genericShareBtn.innerHTML = originalText;
                            }, 2000);

                        } catch (err) {
                            console.error('Fallback error: Could not copy text', err);
                            // Alert the user if copying fails
                            alert('To share, please copy this link: ' + shareUrl);
                        }
                    }
                });

            <?php else : ?>
                // Disable the button if there are no job details to share
                genericShareBtn.disabled = true;
            <?php endif; ?>
        }
        // END MODIFIED

        // PDF Viewer Modal Logic (Unchanged)
        const viewPdfBtn = document.getElementById('viewPdfBtn');
        const pdfViewerModal = new bootstrap.Modal(document.getElementById('pdfViewerModal'));
        const pdfIframe = document.getElementById('pdfIframe');
        const modalDownloadPdfBtn = document.getElementById('modalDownloadPdfBtn');

        if (viewPdfBtn) {
            viewPdfBtn.addEventListener('click', function() {
                const pdfUrl = this.dataset.pdfUrl;
                if (pdfUrl) {
                    pdfIframe.src = pdfUrl; // Set iframe source
                    modalDownloadPdfBtn.href = pdfUrl; // Set download button href
                    pdfViewerModal.show(); // Show the modal
                } else {
                    alert("No PDF file attached to this job post.");
                }
            });
        }
    });
</script>

<?php include 'footer.php'; ?>
</body>
</html>