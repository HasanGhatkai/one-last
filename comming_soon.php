<?php include 'track_visitor.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Coming Soon | Star Cyber Cafe</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: radial-gradient(ellipse at bottom, #1b2735 0%, #090a0f 100%);
      color: white;
      height: 100vh;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .coming-soon-wrapper {
      position: relative;
      text-align: center;
      padding: 30px;
      z-index: 2;
    }

    .glow-circle {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 400px;
      height: 400px;
      background: #00f2ff;
      border-radius: 50%;
      filter: blur(120px);
      animation: pulseGlow 3s ease-in-out infinite;
      z-index: 1;
    }

    @keyframes pulseGlow {
      0%, 100% {
        transform: translate(-50%, -50%) scale(1);
        opacity: 0.7;
      }
      50% {
        transform: translate(-50%, -50%) scale(1.2);
        opacity: 1;
      }
    }

    .coming-soon-content {
      position: relative;
      z-index: 2;
    }

    .glow-text {
      font-size: 3rem;
      font-weight: 600;
      color: #fff;
      text-shadow: 0 0 10px #00f2ff, 0 0 20px #00f2ff;
      margin-bottom: 20px;
    }

    p {
      font-size: 1.2rem;
      margin-bottom: 25px;
    }

    .timer {
      font-size: 1.4rem;
      font-weight: bold;
      margin-bottom: 30px;
    }

    .timer span {
      background: rgba(255, 255, 255, 0.1);
      padding: 10px 15px;
      margin: 5px;
      border-radius: 10px;
      display: inline-block;
    }

    .home-btn {
      display: inline-block;
      background: linear-gradient(90deg, #00f2ff, #00c3ff);
      color: #000;
      font-weight: 600;
      padding: 12px 28px;
      margin-top: 10px;
      border-radius: 30px;
      text-decoration: none;
      box-shadow: 0 0 15px #00f2ff;
      transition: all 0.3s ease;
    }

    .home-btn:hover {
      transform: scale(1.05);
      background: linear-gradient(90deg, #00c3ff, #00f2ff);
      box-shadow: 0 0 25px #00f2ff;
    }

    .social-icons {
      margin: 25px 0 20px;
    }

    .social-icons a {
      color: white;
      margin: 0 10px;
      font-size: 1.5rem;
      transition: transform 0.3s ease;
    }

    .social-icons a:hover {
      transform: scale(1.2);
      color: #00f2ff;
    }

    .footer-text {
      font-size: 0.9rem;
      opacity: 0.6;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .glow-text {
        font-size: 2.2rem;
      }
      .glow-circle {
        width: 300px;
        height: 300px;
      }
    }
  </style>
</head>
<body>

  <div class="coming-soon-wrapper">
    <div class="glow-circle"></div>

    <div class="coming-soon-content">
      <h1 class="glow-text">🚀 Coming Soon</h1>
      <p>This page is getting ready to launch! Stay tuned for updates.</p>

      <a href="index.php" class="home-btn">Go to Homepage</a>

      <div class="social-icons">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
      </div>

      <p class="footer-text">© 2025 Star Cyber Cafe | All rights reserved</p>
    </div>
  </div>
<?php include 'hide_page_url.php'; ?>
</body>
</html>
