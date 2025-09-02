<?php
// PHP logic starts here
// Database connection details
$host = "localhost";
$user = "root";
$pass = "";
$db = "star cyber cafe"; // Replace with your actual database name

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        header('Content-Type: application/json');
        http_response_code(500);
        echo json_encode(['error' => 'Database connection failed: ' . $conn->connect_error]);
        exit();
    } else {
        die("Database connection failed: " . $conn->connect_error);
    }
}
$conn->set_charset("utf8mb4");

// --- This block now correctly handles all AJAX requests for filtering, searching, and pagination ---
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    header('Content-Type: application/json');

    // Get all parameters from the AJAX request
    $searchTerm = $_GET['search'] ?? '';
    $category = $_GET['category'] ?? '';
    $education = $_GET['education'] ?? '';
    $sort = $_GET['sort'] ?? 'newest';
    $is_featured = isset($_GET['is_featured']) && $_GET['is_featured'] === '1';
    $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;

    // --- Build SQL Query WHERE clause and parameters ---
    $whereClauses = [];
    $types = "";
    $param_values = [];

    // Search Term Filter
    if (!empty($searchTerm)) {
        $searchTermWildcard = "%" . $searchTerm . "%";
        $whereClauses[] = "(p.title LIKE ? OR p.rich_text_description LIKE ? OR p.education_required LIKE ?)";
        $types .= "sss";
        $param_values[] = $searchTermWildcard;
        $param_values[] = $searchTermWildcard;
        $param_values[] = $searchTermWildcard;
    }

    // Category Filter
    if (!empty($category)) {
        $whereClauses[] = "c.slug = ?";
        $types .= "s";
        $param_values[] = $category;
    }

    // Education Filter
    if (!empty($education)) {
        $whereClauses[] = "p.education_required = ?";
        $types .= "s";
        $param_values[] = $education;
    }

    // Featured Filter
    if ($is_featured) {
        $whereClauses[] = "p.is_featured = 1";
    }

    $whereSql = "";
    if (!empty($whereClauses)) {
        $whereSql = "WHERE " . implode(" AND ", $whereClauses);
    }

    // --- Sorting Logic ---
    $orderBySql = " ORDER BY p.date_posted DESC"; // Default
    if ($is_featured) {
         // If filtering by featured, always show featured posts first
         $orderBySql = " ORDER BY p.is_featured DESC, p.date_posted DESC";
    }
    switch ($sort) {
        case 'oldest': $orderBySql = " ORDER BY p.date_posted ASC"; break;
        case 'title':  $orderBySql = " ORDER BY p.title ASC"; break;
    }

    // --- Get Total Count (for pagination) ---
    $countSql = "SELECT COUNT(p.id) AS total FROM posts p LEFT JOIN categories c ON p.category_id = c.id " . $whereSql;
    $stmtCount = $conn->prepare($countSql);
    if ($stmtCount === false) {
        http_response_code(500);
        echo json_encode(['error' => 'Error preparing count statement: ' . $conn->error]);
        exit();
    }
    // Bind parameters for the count query if they exist
    if (!empty($types)) {
        $stmtCount->bind_param($types, ...$param_values);
    }
    $stmtCount->execute();
    $countResult = $stmtCount->get_result();
    $totalRecords = $countResult->fetch_assoc()['total'];
    $stmtCount->close();

    // --- Get Actual Vacancy Data ---
    $sql = "SELECT p.*, c.name as category_name, c.slug as category_slug
            FROM posts p
            LEFT JOIN categories c ON p.category_id = c.id
            " . $whereSql . $orderBySql . " LIMIT ? OFFSET ?";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        http_response_code(500);
        echo json_encode(['error' => 'Error preparing data statement: ' . $conn->error]);
        exit();
    }

    // Append types and parameters for LIMIT and OFFSET
    $dataTypes = $types . "ii";
    $dataParams = $param_values; // Copy the existing params
    $dataParams[] = $limit;
    $dataParams[] = $offset;

    // Bind all parameters for the main data query
    if (!empty($dataTypes)) {
        $stmt->bind_param($dataTypes, ...$dataParams);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    $vacancies = [];
    while ($row = $result->fetch_assoc()) {
        $vacancies[] = $row;
    }

    $stmt->close();
    $conn->close();

    // Send the final JSON response back to the JavaScript
    echo json_encode(['vacancies' => $vacancies, 'totalRecords' => (int)$totalRecords]);
    exit(); // IMPORTANT: Stop script execution after sending JSON
}

//--- If not an AJAX request, the script continues to render the HTML page ---

// Fetch categories for the dropdown menu on initial page load
$categories = [];
$catQuery = "SELECT id, name, slug FROM categories ORDER BY name ASC";
$catResult = $conn->query($catQuery);
if ($catResult && $catResult->num_rows > 0) {
    while ($row = $catResult->fetch_assoc()) {
        $categories[] = $row;
    }
}
$conn->close(); // Connection is no longer needed for the HTML part

// --- YOUR INCLUDE FILES ARE PRESERVED HERE ---
include 'track_visitor.php';
include 'cursor-effect.html';
include 'Header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Vacancy Listings</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <style>
     body { background-color: #f8f9fa; }
     .card {
         border-radius: 12px;
         transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
     }
     .card:hover {
         transform: translateY(-5px);
         box-shadow: 0 4px 20px rgba(0,0,0,0.1);
     }
     .card-title { color: #007bff; }
     .badge-featured { background-color: #ffc107 !important; color: #212529 !important; }
     .filter-form {
         background-color: #ffffff;
         padding: 2rem;
         border-radius: 12px;
         box-shadow: 0 2px 10px rgba(0,0,0,0.05);
     }
     .description-snippet {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        min-height: 72px; /* Reserve space to prevent layout shift */
     }
  </style>
</head>
<body>

<div class="container my-4">
  <h2 class="text-center mb-4 text-primary fw-bold">Job Vacancies</h2>
<div class="container my-4">
    <h2 class="text-center mb-4 text-primary fw-bold">Job Vacancies</h2>

    <form id="filterForm" class="row g-3 mb-4 p-4 rounded-4 shadow-sm align-items-end filter-form">
        <div class="col-lg-5 col-md-6 col-sm-12">
            <label for="search" class="form-label fw-bold text-dark">Search Keywords</label>
            <input type="text" name="search" id="search" class="form-control" placeholder="Title, description, education...">
        </div>

        <div class="col-lg-3 col-md-6 col-sm-12">
            <label for="category" class="form-label fw-bold text-dark">Category</label>
            <select name="category" id="category" class="form-select">
                <option value="">All Categories</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= htmlspecialchars($cat['slug']) ?>">
                        <?= htmlspecialchars($cat['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-lg-2 col-md-6 col-sm-12">
            <label for="sort" class="form-label fw-bold text-dark">Sort By</label>
            <select name="sort" id="sort" class="form-select">
                <option value="newest">Newest First</option>
                <option value="oldest">Oldest First</option>
                <option value="title">Title A-Z</option>
            </select>
        </div>

        <div class="col-lg-2 col-md-6 col-sm-12 d-flex justify-content-center align-items-end mt-4 mt-lg-0">
            <button type="submit" class="btn btn-primary w-100 me-2"><i class="fas fa-filter me-2"></i>Apply Filters</button>
            <button type="button" id="resetFiltersBtn" class="btn btn-outline-secondary w-100 ms-2"><i class="fas fa-redo me-2"></i>Reset</button>
        </div>
    </form>
</div>

  <div id="vacanciesContainer" class="row">
    </div>

   <div id="loadingIndicator" class="text-center mt-4" style="display: none;">
      <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
      </div>
  </div>

  <div class="text-center mt-4">
      <button id="loadMoreBtn" class="btn btn-info px-4" style="display: none;"><i class="fas fa-plus-circle me-2"></i>Load More</button>
  </div>
    <div id="noResults" class="alert alert-warning text-center mt-4" role="alert" style="display: none;">
        No vacancies found matching your criteria.
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const filterForm = document.getElementById('filterForm');
    const vacanciesContainer = document.getElementById('vacanciesContainer');
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    const noResultsDiv = document.getElementById('noResults');
    const resetFiltersBtn = document.getElementById('resetFiltersBtn');
    const loadingIndicator = document.getElementById('loadingIndicator');

    let offset = 0;
    const limit = 10;
    let isLoading = false;
    let currentParams = '';

    async function fetchAndRenderVacancies(isNewSearch = false) {
        if (isLoading) return;
        isLoading = true;

        if (isNewSearch) {
            offset = 0;
            vacanciesContainer.innerHTML = '';
        }

        loadingIndicator.style.display = 'block';
        loadMoreBtn.style.display = 'none';
        noResultsDiv.style.display = 'none';

        const formData = new FormData(filterForm);
        const params = new URLSearchParams();
        for (const pair of formData.entries()) {
            if (pair[1]) { // Only add parameter if it has a value
                params.append(pair[0], pair[1]);
            }
        }
        params.append('offset', offset);
        params.append('limit', limit);
        
        currentParams = params.toString();

        try {
            // The fetch URL points to the current page itself ('?' tells the browser to make a request to the same URL)
            const response = await fetch(`?${currentParams}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest', // This header is crucial for the PHP to know it's an AJAX call
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) throw new Error(`Server Error: ${response.statusText}`);
            
            const data = await response.json();
            if (data.error) throw new Error(data.error);

            if (data.vacancies.length === 0 && offset === 0) {
                noResultsDiv.style.display = 'block';
            }

            data.vacancies.forEach(vacancy => {
                const formattedDate = new Date(vacancy.date_posted).toLocaleDateString(undefined, { year: 'numeric', month: 'short', day: 'numeric' });
                
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = vacancy.rich_text_description || '';
                const descriptionText = tempDiv.textContent || tempDiv.innerText || 'No description available.';

                const vacancyCard = `
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">${escapeHtml(vacancy.title)}</h5>
                                <h6 class="card-subtitle mb-2 text-muted small">
                                    <i class="fas fa-tag me-1"></i>${escapeHtml(vacancy.category_name || 'N/A')} |
                                    <i class="fas fa-graduation-cap me-1"></i>${escapeHtml(vacancy.education_required || 'N/A')}
                                </h6>
                                <p class="card-text description-snippet">${escapeHtml(descriptionText)}</p>
                                <div class="mt-auto">
                                    <a href="job_details.php?id=${vacancy.id}" class="btn btn-sm btn-info mt-2">Read More <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                            <div class="card-footer text-muted d-flex justify-content-between align-items-center">
                                <small>Posted on ${formattedDate}</small>
                                ${vacancy.is_featured == 1 ? `<span class="badge badge-featured"><i class="fas fa-star me-1"></i>Featured</span>` : ''}
                            </div>
                        </div>
                    </div>`;
                vacanciesContainer.insertAdjacentHTML('beforeend', vacancyCard);
            });

            offset += data.vacancies.length;
            if (offset < data.totalRecords) {
                loadMoreBtn.style.display = 'block';
            }

        } catch (error) {
            console.error('Failed to fetch vacancies:', error);
            vacanciesContainer.innerHTML = `<div class="col-12"><div class="alert alert-danger">${error.message}</div></div>`;
        } finally {
            isLoading = false;
            loadingIndicator.style.display = 'none';
        }
    }

    function escapeHtml(str) {
        if (str === null || str === undefined) return '';
        return str.toString().replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
    }

    // Event Listeners
    filterForm.addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent page reload
        fetchAndRenderVacancies(true); // 'true' for new search
    });

    resetFiltersBtn.addEventListener('click', function() {
        filterForm.reset();
        fetchAndRenderVacancies(true); // 'true' for new search
    });

    loadMoreBtn.addEventListener('click', function() {
        fetchAndRenderVacancies(false); // 'false' to append results
    });

    // Initial load of vacancies when the page is ready
    fetchAndRenderVacancies(true);
});
</script>

<?php
// --- YOUR FOOTER INCLUDE IS PRESERVED HERE ---
include 'footer.php';
?>
</body>
</html>