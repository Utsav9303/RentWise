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
        @media (max-width: 572px) {
            .signup {
                display: none;
            }
        }

        #about {
            background: var(--mainhover-color) !important;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"
        crossorigin="anonymous"></script>

    <style>
        .toggle-container {
            display: flex;
            align-items: center;
            gap: 1rem;
            position: relative;
        }

        .option-label {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.1rem;
            font-weight: 600;
            color: #6b7280;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .option-label.active {
            color: #3b82f6;
        }

        .option-label i {
            font-size: 1.5rem;
            transition: inherit;
        }

        .toggle-switch {
            position: relative;
            width: 5rem;
            height: 2.5rem;
            background: #e5e7eb;
            border-radius: 2rem;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .toggle-thumb {
            position: absolute;
            top: 0.25rem;
            left: 0.25rem;
            width: 2rem;
            height: 2rem;
            background: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .toggle-thumb i {
            font-size: 1.1rem;
            color: #6b7280;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Active state */
        .toggle-switch.active {
            background: #bfdbfe;
        }

        .toggle-switch.active .toggle-thumb {
            transform: translateX(2.5rem);
            background: #3b82f6;
        }

        .toggle-switch.active .toggle-thumb i {
            color: white;
        }

        /* Label transitions */
        .option-label:not(.active) {
            opacity: 0.7;
            transform: scale(0.95);
        }

        .option-label.active {
            opacity: 1;
            transform: scale(1);
        }

        .toggle-thumb i {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        .toggle-switch.active .toggle-thumb i {
            transform: rotate(0deg) !important;
        }


        /* Property Type Selector */
.property-type-group {
    margin: 1.5rem 0;
}

.switch-field.property-type {
    display: flex;
    gap: 0.8rem;
    justify-content: center;
    flex-wrap: wrap;
}

.switch-field.property-type input[type="radio"] {
    position: absolute;
    opacity: 0;
}

.switch-field.property-type label {
    flex: 1;
    padding: 1rem 1.5rem;
    background: #f8f9fa;
    border: 2px solid #e9ecef;
    border-radius: 1rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    align-items: center;
    gap: 0.5rem;
    justify-content: center;
    min-width: 120px;
}

.switch-field.property-type label i {
    font-size: 1.2rem;
    color: #3b82f6;
    transition: inherit;
}

.switch-field.property-type input[type="radio"]:checked + label {
    background: #3b82f6;
    border-color: #3b82f6;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(59, 130, 246, 0.2);
}

.switch-field.property-type input[type="radio"]:checked + label i {
    color: white;
}

.switch-field.property-type label:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Responsive Design */
@media (max-width: 480px) {
    .switch-field.property-type {
        gap: 0.5rem;
    }
    
    .switch-field.property-type label {
        padding: 0.8rem 1rem;
        font-size: 0.9rem;
        min-width: 100px;
    }
    
    .switch-field.property-type label i {
        font-size: 1rem;
    }
}

@media (max-width: 360px) {
    .switch-field.property-type {
        flex-direction: column;
    }
    
    .switch-field.property-type label {
        width: 100%;
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

    <!-- Combined Form -->
    <form class="form">
        <h2>Area (Square Feet)</h2>
        <input class="area" type="text" id="uiSqft" class="floatLabel" name="Squareft" value="1000">

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
            <input type="radio" id="radio-bhk-5" name="uiBHK" value="5" />
            <label for="radio-bhk-5">5</label>
        </div>
        <br>
        <div class="toggle-container">
            <span class="option-label active">
                <i class="fas fa-home"></i>
                Unfurnished
            </span>

            <div class="toggle-switch" id="toggleSwitch">
                <div class="toggle-thumb">
                    <i class="fas fa-home" id="thumbIcon"></i> <!-- Initial house icon inside the thumb -->
                </div>
            </div>

            <span class="option-label">
                <i class="fas fa-couch"></i>
                Furnished
            </span>
        </div>
        <br><br>
        <script>
            const toggleSwitch = document.getElementById('toggleSwitch');
            const labels = document.querySelectorAll('.option-label');
            const thumbIcon = document.getElementById('thumbIcon');

            toggleSwitch.addEventListener('click', () => {
                // Toggle active state for switch
                toggleSwitch.classList.toggle('active');

                // Toggle active state for labels
                labels.forEach(label => label.classList.toggle('active'));

                if (toggleSwitch.classList.contains('active')) {
                    thumbIcon.classList.replace('fa-home', 'fa-couch'); // Change to couch
                } else {
                    thumbIcon.classList.replace('fa-couch', 'fa-home'); // Change to house
                }
            });
        </script>

        <!-- Add this after BHK section -->
<h2>Property Type</h2>
<div class="property-type-group">
    <div class="switch-field">
        <input type="radio" id="apartment" name="propertyType" value="apartment" checked/>
        <label for="apartment">
            <i class="fas fa-home"></i>
            Tenament
        </label>
        
        <input type="radio" id="flat" name="propertyType" value="flat"/>
        <label for="flat">
            <i class="fas fa-building"></i>
            Flat
        </label>
        
        <input type="radio" id="bungalow" name="propertyType" value="bungalow"/>
        <label for="bungalow">
            <i class="fas fa-place-of-worship"></i>
            Villa
        </label>
    </div>
</div>

        <h2>Location</h2>
        <select class="location" name="location" id="uiLocations">
            <option value="" disabled selected>Choose a Location</option>
            <option>Electronic City</option>
            <option>Rajaji Nagar</option>
        </select>

        <button class="submit" onclick="onClickedEstimatePrice()" type="button">Estimate Price</button>
        <div id="uiEstimatedPrice" class="result">
            <h2></h2>
        </div>
    </form>

    <!-- Single Footer Inclusion -->
    <?php require("../shortlink/home_foot.php"); ?>

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