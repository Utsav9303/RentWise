<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <!-- LInk To CSS -->
    <link rel="stylesheet" href="../css/style.css">

    <!-- online links -->
    <?php require("../links/links.php") ?>

    <style>
        .signup {
            display: none;
        }

        @media screen and (max-width: 768px) {
            .wrapper {
                width: 90%;
                padding: 20px;
            }

            .input-box {
                flex-direction: column;
                align-items: flex-start;
            }

            .input-box input {
                width: 100%;
            }

            .eye-icon {
                right: 10px;
            }

            .option_field {
                flex-direction: row;
                align-items: center;
            }

            .option_field label {
                margin-left: 5px;
                font-size: 14px;
            }

            .button input {
                width: 100%;
            }

            .text h3 {
                font-size: 14px;
            }
        }

        @media screen and (max-width: 480px) {
            .wrapper {
                width: 100%;
                padding: 15px;
            }

            h2 {
                font-size: 20px;
                text-align: center;
            }

            .input-box {
                width: 100%;
            }

            .option_field label {
                font-size: 12px;
            }

            .text h3 {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">

        </div>
    </div>
    <!-- Spinner End -->

    <!-- This will add Header -->
    <?php require("../shortlink/header.php") ?>

    <section class="dd">
        <div class="wrapper">
            <h2>SignUp</h2>
            <form method="post">
                <div class="input-box">
                    <span class="material-symbols-outlined input-icon">
                        person
                    </span>
                    <input type="text" name="name" placeholder="Username" maxlength="20" required>
                </div>
                <div class="input-box">
                    <span class="material-symbols-outlined input-icon">
                        smartphone
                    </span>
                    <input type="text" name="mobile" placeholder="Mobile" minlength="10" maxlength="10" required>
                </div>
                <div class="input-box">
                    <span class="material-symbols-outlined input-icon">
                        mail
                    </span>
                    <input type="email" name="email" placeholder="E-mail" maxlength="30" required>
                </div>
                <div class="input-box">
                    <span class="material-symbols-outlined input-icon">
                        lock
                    </span>
                    <input type="password" onfocus="showEye1()" id="password1" minlength="8" maxlength="20"
                        name="password" placeholder="Password" required>
                    <span class="material-symbols-outlined eye-icon" id="togglePassword1">
                        visibility_off
                    </span>

                </div>
                <div class="input-box">
                    <span class="material-symbols-outlined input-icon">
                        lock
                    </span>
                    <input type="password" onfocus="showEye2()" id="password2" minlength="8" maxlength="20" name="cpass"
                        placeholder="Confirm Password" required>
                    <span class="material-symbols-outlined eye-icon" id="togglePassword2">
                        visibility_off
                    </span>

                </div>
                <!-- <div class="policy">
                    <input type="checkbox" required>
                    <h3>I accept all Terms & Conditions</h3>
                </div> -->
                <div class="option_field">
                    <span class="checkboxs">
                        <input type="checkbox" id="check" required>
                        <label for="check">I accept the Terms & Conditions</label>
                    </span>
                </div>
                <div class="input-box button">
                    <input type="Submit" class="log-sign" name="signup" value="Signup">
                </div>
                <div class="text">
                    <h3>Already have an account? <a href="./login.php">Login now</a></h3>
                </div>
            </form>
        </div>
    </section>
    </div>
    <!-- This will add Footer -->
    <?php //require("../shortlink/footer.php") ?>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/showpass.js"></script>
    <script>
        document.getElementById("search").style.display = "none";
    </script>

</body>

</html>
<?php

/*
This code is prepared to perform the backend process for the signup procedure of the website.
author:-KHD solutions.
*/
require("../shortlink/connection.php");

if (!$conn) {

    ?>
    <script>
        alert("Error with the database, Please try after some time.");
    </script>
    <?php

} else {
    if (isset($_POST['signup'])) {
        //Taking user information
        $un = mysqli_real_escape_string($conn, $_POST['name']);
        $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = mysqli_real_escape_string($conn, $_POST['password']);
        $cpass = mysqli_real_escape_string($conn, $_POST['cpass']);

        // password and confirm password matching
        if ($pass != $cpass) {
            ?>
            <script>
                alert("Password and ConfirmPassword are not same.");
            </script>
            <?php
        } else {

            //password encryption
            $ph = password_hash($pass, PASSWORD_BCRYPT);

            //Cheking for the matched entry.
            $sl = "SELECT * FROM user WHERE username='$un' or email= '$email' or mobile='$mobile'";
            $match = mysqli_query($conn, $sl);

            if (mysqli_num_rows($match) == 1) {
                ?>
                <script>
                    alert("This Account is already exist.");
                </script>
                <?php
            } else {
                // Insert user data
                $in = "INSERT INTO user(username,email,mobile,password) VALUES('$un','$email','$mobile','$ph')";
                $q3 = mysqli_query($conn, $in);

                if ($q3) {
                    // Get the newly inserted user id
                    $new_user_id = mysqli_insert_id($conn);

                    // Insert a sample property for this new user
                    $sample_city = 'Sample City';
                    $sample_society = 'Sample Society';
                    $sample_area = 'Sample Area';
                    $sample_type = 'Sample Type';
                    $sample_pro_no = 'S-001';
                    $sample_rent_sell = 'Rent';
                    $sample_p_space = 'N/A';
                    $sample_price = 0;
                    $sample_description = 'This is a sample property added by default upon registration.';
                    $sample_latitude = 0;
                    $sample_longitude = 0;

                    $sample_sql = "INSERT INTO property 
                        (u_id, city, society, area, type, pro_no, rent_sell, p_space, price, description, location) 
                        VALUES ($new_user_id, '$sample_city', '$sample_society', '$sample_area', '$sample_type', '$sample_pro_no', '$sample_rent_sell', '$sample_p_space', $sample_price, '$sample_description', POINT($sample_latitude, $sample_longitude))";
                    
                    mysqli_query($conn, $sample_sql);

                    echo "<script>alert('Signup successful, a sample property has been added. Please login now.'); window.top.location = './login.php';</script>";
                } else {
                    echo "<script>alert('Error occurred during signup. Please try again.');</script>";
                }

                ?>

                <script>
                    alert("Signup successful, Please Login now.");
                    window.top.location = './login.php';
                </script>

                

                <?php
            }
        }
    }
}
?>