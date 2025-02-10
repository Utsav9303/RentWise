<?php
session_start();

if (!isset($_SESSION['u_id'])) {
    header("location: ../login-signup/login.php");
}

if ($_SESSION['counter'] == 0) {
    ?>
    <script>
        alert("Welcome <?php echo $row['username']; ?>");
    </script>
    <?php
    $_SESSION['counter']++;
}

require("../shortlink/connection.php");

$id = $_SESSION['u_id'];
$q = "SELECT * FROM user WHERE u_id=" . $id;
$match = mysqli_query($conn, $q);
$res = mysqli_num_rows($match);
$row = mysqli_fetch_assoc($match);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Bangalore Home Price Prediction</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="app.js"></script>
    <link rel="stylesheet" href="app.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="./about.css">
    <?php require("../links/links.php") ?>
    <style>
    /* Overall Page Styling */
    body {
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }

    /* Header (matching your site's header style) */
    .site-header {
      background: #ffffff;
      padding: 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }

    .site-header h1 {
      color: #3b82f6;
      font-size: 1.8rem;
    }

    /* Footer (matching your site's footer style) */
    .site-footer {
      background: #ffffff;
      padding: 20px;
      text-align: center;
      box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
      margin-top: 20px;
    }

    .site-footer p {
      color: #6b7280;
      font-size: 0.9rem;
    }

    /* Main Title */
    .title {
      text-align: center;
      font-size: 2.8rem;
      color: #333;
      margin-top: 20px;
      margin-bottom: 30px;
      font-weight: 700;
    }

    /* Cities Grid */
    .cities-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 30px;
    }

    /* Updated City Card Style (Smooth & Modern) */
    .city-card {
      background: #fff;
      border-radius: 16px;
      overflow: hidden;
      position: relative;
      text-align: center;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      transition: transform 0.4s ease, box-shadow 0.4s ease;
      cursor: pointer;
    }

    .city-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    }

    /* City Image */
    .city-image {
      width: 60%;
      height: 200px;
      background-size: cover;
      background-position: center;
      transition: transform 0.4s ease;
      margin: auto;
    }

    .city-card:hover .city-image {
      transform: scale(1.05);
    }

    /* City Info */
    .city-info {
      padding: 20px;
      background: #fff;
    }

    .city-name {
      font-size: 1.8rem;
      font-weight: 600;
      margin-bottom: 10px;
      color: #333;
    }

    .city-description {
      font-size: 1rem;
      color: #777;
      margin-bottom: 20px;
    }

    /* Select Button */
    .select-button {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 10px 20px;
      background: #3b82f6;
      color: #fff;
      border: none;
      border-radius: 30px;
      font-size: 1rem;
      transition: background 0.3s ease, transform 0.2s ease;
      cursor: pointer;
    }

    .select-button:hover {
      background: #60a5fa;
      transform: scale(1.05);
    }

    /* Grid layout for responsiveness */
    .cities-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 30px;
    }

    /* City Card Styling */
    .city-card {
      background: #fff;
      border-radius: 16px;
      overflow: hidden;
      position: relative;
      text-align: center;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      transition: transform 0.4s ease, box-shadow 0.4s ease;
      cursor: pointer;
      display: flex;
      flex-direction: column;
      min-height: 300px;
      /* Ensures all cards have the same height */
    }


    /* Ensures city name & description stick to bottom */
    .city-info {
      display: flex;
      flex-direction: column;
      flex-grow: 1;
      /* Pushes content down */
      justify-content: flex-end;
      padding: 15px;
    }

    /* City Name & Description */
    .city-name {
      font-size: 1.6rem;
      font-weight: 600;
      margin-bottom: 5px;
      color: #333;
    }

    .city-description {
      font-size: 1rem;
      color: #777;
      margin-bottom: 10px;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
      .title {
        font-size: 2.2rem;
        margin-bottom: 20px;
      }

      .cities-grid {
        gap: 20px;
      }
    }

    /* For Mobile Screens: show 2 cards per row */
    @media (max-width: 480px) {
      .cities-grid {
        grid-template-columns: repeat(2, 1fr);
      }

      .container-fluid {
        padding: auto !important;
      }

      @media (max-width: 768px) {
        .cities-grid {
          grid-template-columns: repeat(2, 1fr);
          /* Two cards per row */
          gap: 15px;
        }

        .city-card {
          min-height: 250px;
          /* Smaller height for mobile */
        }

        .city-image {
          height: 125px;
          /* Adjusted image height */
          width: 80%;
          margin: 15px auto 0;
          border-radius: 12px;
        }

        .city-name {
          font-size: 1.4rem;
        }

        .city-description {
          font-size: 0.9rem;
        }
      }
  </style>
</head>

<body>
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status"></div>
    </div>

    <!-- Header -->
    <?php require("../shortlink/home_head.php"); ?>

    <div class="img"></div>


  <main class="container">
    <h2 class="title">Select Your City</h2>
    <div class="cities-grid">
      <!-- Updated city cards with capitalized city names -->
      <div class="city-card" data-city="Bangalore" onclick="redirectToApp('Bangalore')">
        <div class="city-image" style="background-image: url('./graphics/bangalore.png');"></div>
        <div class="city-info">
          <div class="city-name">Bangalore</div>
          <div class="city-description">The Silicon Valley of India</div>
        </div>
      </div>

      <div class="city-card" data-city="Mumbai" onclick="redirectToApp('Mumbai')">
        <div class="city-image" style="background-image: url('./graphics/mumbai.png');"></div>
        <div class="city-info">
          <div class="city-name">Mumbai</div>
          <div class="city-description">The City of Dreams</div>
        </div>
      </div>

      <div class="city-card" data-city="Delhi" onclick="redirectToApp('Delhi')">
        <div class="city-image" style="background-image: url('./graphics/delhi.png');"></div>
        <div class="city-info">
          <div class="city-name">Delhi</div>
          <div class="city-description">The Heart of India</div>
        </div>
      </div>

      <div class="city-card" data-city="Kolkata" onclick="redirectToApp('Kolkata')">
        <div class="city-image" style="background-image: url('./graphics/kolkata.png');"></div>
        <div class="city-info">
          <div class="city-name">Kolkata</div>
          <div class="city-description">The Cultural Capital</div>
        </div>
      </div>

      <div class="city-card" data-city="Chennai" onclick="redirectToApp('Chennai')">
        <div class="city-image" style="background-image: url('./graphics/chennai.png');"></div>
        <div class="city-info">
          <div class="city-name">Chennai</div>
          <div class="city-description">The Gateway to South India</div>
        </div>
      </div>

      <div class="city-card" data-city="Hyderabad" onclick="redirectToApp('Hyderabad')">
        <div class="city-image" style="background-image: url('./graphics/hyderabad.png');"></div>
        <div class="city-info">
          <div class="city-name">Hyderabad</div>
          <div class="city-description">City of Pearls</div>
        </div>
      </div>

      <div class="city-card" data-city="Pune" onclick="redirectToApp('Pune')">
        <div class="city-image" style="background-image: url('./graphics/pune.png');"></div>
        <div class="city-info">
          <div class="city-name">Pune</div>
          <div class="city-description">The Oxford of the East</div>
        </div>
      </div>

      <div class="city-card" data-city="Ahmedabad" onclick="redirectToApp('Ahmedabad')">
        <div class="city-image" style="background-image: url('./graphics/ahmedabad.png');"></div>
        <div class="city-info">
          <div class="city-name">Ahmedabad</div>
          <div class="city-description">The Vibrant Heart of Gujarat</div>
        </div>
      </div>
    </div>
  </main>

  <?php require("../shortlink/home_foot.php"); ?>

<script src="../js/main.js"></script>
<script>
    document.getElementById("search").style.display = "none";

    function onLogout() {
        if (confirm("Are you sure you want to logout?")) {
            window.top.location = '../login-signup/logout.php';
        }
    }

    // Updated redirect function
    function redirectToApp(city) {
      localStorage.setItem('selectedCity', city);
      window.location.href = 'app.php';
    }

    // Hide spinner when page loads
    window.addEventListener('load', () => {
        const spinner = document.getElementById('spinner');
        spinner.style.display = 'none';
    });
</script>
</body>

</html>