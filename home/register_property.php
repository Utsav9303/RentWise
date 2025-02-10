<?php
session_start();
require("../shortlink/connection.php");

if (isset($_POST['register'])) {
    // Validate session and connection
    if (!isset($_SESSION['u_id']) || !$conn) {
        die("Invalid session or database connection");
    }

    // Prepare data with validation
    $id = $_SESSION['u_id'];
    $p_type = mysqli_real_escape_string($conn, $_POST['p_type'] ?? '');
    $p_no = mysqli_real_escape_string($conn, $_POST['p_no'] ?? '');
    $p_rns = mysqli_real_escape_string($conn, $_POST['p_rns'] ?? '');
    $p_space = mysqli_real_escape_string($conn, $_POST['p_space'] ?? '');
    $p_price = (float)($_POST['p_price'] ?? 0);
    $p_city = mysqli_real_escape_string($conn, $_POST['p_city'] ?? '');
    $p_area = mysqli_real_escape_string($conn, $_POST['p_area'] ?? '');
    $p_society = mysqli_real_escape_string($conn, $_POST['p_society'] ?? '');
    $p_desc = mysqli_real_escape_string($conn, $_POST['p_description'] ?? '');

    $latitude = (float)$_POST['latitude'];
    $longitude = (float)$_POST['longitude'];

    // Start transaction
    mysqli_begin_transaction($conn);

    try {
        // Check existing property using prepared statement
        $check_sql = "SELECT pr_id FROM property 
                     WHERE city = ? AND society = ? AND pro_no = ?";
        $stmt = mysqli_prepare($conn, $check_sql);
        mysqli_stmt_bind_param($stmt, "sss", $p_city, $p_society, $p_no);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            throw new Exception("Property already registered");
        }

        // Insert property using prepared statement
        $insert_sql = "INSERT INTO property 
                      (u_id, city, society, area, type, pro_no, rent_sell, p_space, price, description, location) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, POINT($latitude, $longitude))";
        $stmt = mysqli_prepare($conn, $insert_sql);
        mysqli_stmt_bind_param($stmt, "isssssssds", 
            $id, $p_city, $p_society, $p_area, $p_type, $p_no, 
            $p_rns, $p_space, $p_price, $p_desc
        );

        if ($q3) {
            echo "<script>alert('Property registered successfully!'); window.location.href='./profile.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location.href='./profile.php';</script>";
        }

        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Property registration failed: " . mysqli_error($conn));
        }

        $pr_id = mysqli_insert_id($conn);

        // Handle file uploads
        if (!isset($_FILES['upload']) || !is_array($_FILES['upload']['name'])) {
            throw new Exception("No files uploaded");
        }

        $upload_dir = "../Uploads/Users/$id/P$pr_id/";
        if (!file_exists($upload_dir) && !mkdir($upload_dir, 0755, true)) {
            throw new Exception("Failed to create upload directory");
        }

        foreach ($_FILES['upload']['name'] as $i => $name) {
            // Skip empty file slots
            if ($_FILES['upload']['error'][$i] === UPLOAD_ERR_NO_FILE) continue;

            // Validate file
            if ($_FILES['upload']['error'][$i] !== UPLOAD_ERR_OK) {
                throw new Exception("File upload error: " . $_FILES['upload']['error'][$i]);
            }

            if ($_FILES['upload']['size'][$i] > 2500000) {
                throw new Exception("File too large: " . $name);
            }

            $imgEx = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            if (!in_array($imgEx, ['jpg', 'png', 'jpeg'])) {
                throw new Exception("Invalid file type: " . $name);
            }

            // Generate unique filename
            $new_name = uniqid("IMG-", true) . '.' . $imgEx;
            $target_path = $upload_dir . $new_name;

            if (!move_uploaded_file($_FILES['upload']['tmp_name'][$i], $target_path)) {
                throw new Exception("Failed to move uploaded file: " . $name);
            }

            // Insert photo record
            $photo_sql = "INSERT INTO prop_photo (pr_id, photo) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $photo_sql);
            mysqli_stmt_bind_param($stmt, "is", $pr_id, $new_name);
            
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Failed to save photo record: " . mysqli_error($conn));
            }
        }

        // Commit transaction
        mysqli_commit($conn);

        // Success response
        $_SESSION['success'] = "Property registered successfully!";
        header("Location: ./profile.php");
        exit();

    } catch (Exception $e) {
        mysqli_rollback($conn);
        $_SESSION['error'] = $e->getMessage();
        header("Location: ./profile.php");
        exit();
    }
}