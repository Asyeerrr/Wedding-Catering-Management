<?php
session_start();

// Check if the user is logged in and has the required role
if (!isset($_SESSION["user"]) || $_SESSION["role"] !== "Admin") {
    header("Location: index.php");
    exit; // Ensure to exit after redirection
}

// Include your database connection file
require_once "database.php";

// Check if 'id' is set in the GET request
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Determine the table to delete from based on the referring page
    $table = "";
    $referer = $_SERVER['HTTP_REFERER'];
    if (strpos($referer, 'catering_staff.php') !== false) {
        $table = "cater_staff";
    } elseif (strpos($referer, 'wedding_staff.php') !== false) {
        $table = "wed_staff";
    }

    if (!empty($table)) {
        // Prepare and execute the delete query
        $query = "DELETE FROM $table WHERE staff_id = ?";
        $statement = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($statement, "i", $id);
        $result = mysqli_stmt_execute($statement);

        if ($result) {
            // Redirect to the referring page after successful deletion
            header("Location: $referer");
            exit; // Ensure to exit after redirection
        } else {
            // Handle error
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid table specified.";
    }
} else {
    echo "Invalid request.";
}
?>
