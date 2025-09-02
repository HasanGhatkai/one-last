<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Star Cyber Cafe Footer</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <!-- Custom Primary Color -->
  <style>
    :root {
      --bs-primary: #1e90ff;
    }

    footer {
      background-color: #212529;
      color: #fff;
    }

    footer a {
      color: #ccc;
      text-decoration: none;
    }

    footer a:hover {
      color: var(--bs-primary);
    }

    .social-icons a {
      font-size: 22px;
      margin-right: 15px;
      color: #ccc;
      transition: color 0.3s ease;
    }

    .social-icons a:hover {
      color: var(--bs-primary);
    }

    .footer-bottom {
      border-top: 1px solid #444;
      padding-top: 15px;
      font-size: 14px;
      color: #aaa;
    }

    .footer-title {
      color: var(--bs-primary);
    }

    .footer-icon {
      margin-right: 8px;
      color: var(--bs-primary);
    }

    .contact-info i {
      color: var(--bs-primary);
      margin-right: 8px;
    }

    .quick-links li {
      margin-bottom: 8px;
    }
  </style>
</head>
<body>

  <!-- Footer Start -->
  <footer class="pt-4 pb-3">
    <div class="container">
      <div class="row">

        <!-- About Section -->
        <div class="col-md-4 mb-4">
          <h5 class="footer-title">⭐ Star Cyber Cafe</h5>
          <p>Your trusted destination for all digital and government form needs!<br><br>
            From online form filling to job vacancy updates, we offer complete assistance for:<br>
            📄 Online Forms | 🛂 Passport | 🆔 PAN Card | 🧾 Udyog Aadhaar | 🍽️ Food License | 🚗 Driving License | 🎓 Scholarships | 🏛️ Government Assistance | 🧾 Aadhaar Card | 💳 PVC Card | 🖨️ Printing | 📠 Scanning — all under one roof!
          </p>
        </div>

        <!-- Quick Links -->
        <div class="col-md-4 mb-4">
          <h5 class="footer-title">Quick Links</h5>
          <ul class="list-unstyled quick-links">
            <li><a href="index.php"><i class="fas fa-angle-right footer-icon"></i>Home</a></li>
            <li><a href="vacancies_listing_page.php"><i class="fas fa-angle-right footer-icon"></i>View All Update</a></li>
            <li><a href="about_us.php"><i class="fas fa-angle-right footer-icon"></i>About Us</a></li>
          </ul>
        </div>

        <!-- Contact & Social -->
        <div class="col-md-4 mb-4">
          <h5 class="footer-title">Contact Us</h5>
          <div class="contact-info">
            <p><i class="fas fa-map-marker-alt"></i>Jalaram Chowk, Near Bhakti Nagar Circle, Geeta Mandir Main Rd, Rajkot, Gujarat 360002</p>
            <p><i class="fas fa-phone"></i>+91 80007 77102</p>
            <p><i class="fas fa-envelope"></i>cafe.star92@gmail.com</p>
          </div>
          <div class="social-icons mt-3">
            <a href="https://www.facebook.com/STARCYBERCAFERAJKOT/" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/p/DLXi2M3yONx/?utm_source=ig_web_button_share_sheet" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://wa.me/918000777102" target="_blank"><i class="fab fa-whatsapp"></i></a>
            <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
          </div>
        </div>

      </div>

      <!-- Footer Bottom -->
      <div class="text-center footer-bottom mt-3">
        <small>&copy; <?= date("Y") ?> Star Cyber Cafe. All rights reserved.</small>
      </div>
    </div>
  </footer>
  <!-- Footer End -->

</body>
</html>
