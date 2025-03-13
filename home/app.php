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
      max-width: 500px;
      margin: 20px auto;
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



    <!-- Updated Form -->
    <form class="container">
        <h2><span id="city-name"></span> Home Price Prediction</h2>

        <h2>Area (Square Feet)</h2>
        <input class="area" type="number" id="uiSqft" min="100" step="50" value="1000">

        <h2>BHK</h2>
        <div class="switch-field">
            <input type="radio" id="radio-bhk-1" name="uiBHK" value="1" />
            <label for="radio-bhk-1">1</label>
            <input type="radio" id="radio-bhk-2" name="uiBHK" value="2" checked />
            <label for="radio-bhk-2">2</label>
            <input type="radio" id="radio-bhk-3" name="uiBHK" value="3" />
            <label for="radio-bhk-3">3</label>
            <input type="radio" id="radio-bhk-4" name="uiBHK" value="4" />
            <label for="radio-bhk-4">4</label>
        </div>

        <h2>Furnishing Type</h2>
        <div class="toggle-container">
            <span class="option-label active">
                <i class="fas fa-home"></i>
                Unfurnished
            </span>

            <div class="toggle-switch" id="toggleSwitch">
                
                <div class="toggle-thumb">
                </div>
            </div>

            <span class="option-label">
                <i class="fas fa-couch"></i>
                Furnished
            </span>
        </div>
        <br>

        <h2>Property Type</h2>
        <div class="property-type-group">
            <div class="switch-field">
                <input type="radio" id="apartment" name="propertyType" value="apartment" checked />
                <label for="apartment">
                    <i class="fas fa-building"></i>
                    Apartment
                </label>
                <input type="radio" id="independent_house" name="propertyType" value="independent house" />
                <label for="independent_house">
                    <i class="fas fa-home"></i>
                    House
                </label>
                <input type="radio" id="villa" name="propertyType" value="villa" />
                <label for="villa">
                    <i class="fas fa-place-of-worship"></i>
                    Villa
                </label>
            </div>
        </div>

        <h2>Location</h2>
        <select class="location" id="locality">
            <option value="" disabled selected>Loading localities...</option>
        </select>

        <button class="submit" type="button" onclick="predictPrice()">Estimate Price</button>
        <div id="uiEstimatedPrice" class="result">
            <h2></h2>
        </div>
    </form>

    <?php require("../shortlink/home_foot.php"); ?>

    <script>
        // Initialize page
        $(document).ready(function () {
            // Set city name from localStorage
            const selectedCity = localStorage.getItem('selectedCity') || 'Bangalore';
            $('#city-name').text(selectedCity);

            // Load localities
            loadLocalities();

            // Initialize toggle switch
            const toggleSwitch = $('#toggleSwitch');
            const labels = $('.option-label');
            const thumbIcon = $('#thumbIcon');

            toggleSwitch.on('click', function () {
                // Toggle active state using jQuery
                $(this).toggleClass('active');
                labels.toggleClass('active');

                // Use classList.replace with vanilla JS element
                const iconElement = thumbIcon[0]; // Get DOM element from jQuery object
                if ($(this).hasClass('active')) {
                    iconElement.classList.replace('fas fa-home', 'fas fa-couch');
                } else {
                    iconElement.classList.replace('fas fa-couch', 'fas fa-home');
                }
            });
        });

        function loadLocalities() {
            const selectedCity = localStorage.getItem('selectedCity') || 'Bangalore';
            const url = `http://192.168.34.17:5000/get_localities?city=${encodeURIComponent(selectedCity)}`;

            $.get(url, function (data) {
                $('#locality').empty().append('<option value="" disabled selected>Choose a Location</option>');
                data.localities.forEach(locality => {
                    $('#locality').append($('<option>', {
                        value: locality,
                        text: locality
                    }));
                });
            }).fail(() => console.error("Error fetching localities"));
        }

        function predictPrice() {
            const selectedCity = localStorage.getItem('selectedCity') || 'Bangalore';
            const requestData = {
                city: selectedCity,
                area: parseFloat($('#uiSqft').val()),
                bhk: parseInt($('input[name="uiBHK"]:checked').val()),
                property_type: $('input[name="propertyType"]:checked').val(),
                furnish_type: $('#toggleSwitch').hasClass('active') ? 'furnished' : 'unfurnished',
                locality: $('#locality').val()
            };

            if (!requestData.area || requestData.area <= 0) {
                alert("Please enter a valid area");
                return;
            }

            $.ajax({
                url: 'http://192.168.34.17:5000/predict',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(requestData),
                success: (data) => {
                    $('#uiEstimatedPrice h2').text(`${data.prediction.toFixed(2)} Lakh`);
                },
                error: () => {
                    $('#uiEstimatedPrice h2').text("Error Fetching Prediction");
                }
            });
        }
    </script>
    <script src="../js/main.js"></script>
    <script>
        document.getElementById("search").style.display = "none";

        function onLogout() {
            if (confirm("Are you sure you want to logout?")) {
                window.top.location = '../login-signup/logout.php';
            }
        }

        // Hide spinner when page loads
        window.addEventListener('load', () => {
            const spinner = document.getElementById('spinner');
            spinner.style.display = 'none';
        });
    </script>
</body>

</html>