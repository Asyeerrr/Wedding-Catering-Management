<?php
session_start();
if (!isset($_SESSION["user"]) || $_SESSION["role"] !== "Admin") {
    header("Location: index.php");
    exit; // Ensure to exit after redirection
    
}

// Include your database connection file
require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $contact = $_POST["contact"];
    $age = $_POST["age"];
    $salary_plain = $_POST["salary"];
    $duty = $_POST["duty"];
    $role = $_POST["role"];

    // Determine the appropriate table based on the role
    if ($role === "Wedding Staff") {
        $table = "wed_staff";
    } elseif ($role === "Catering Staff") {
        $table = "cater_staff";
    } else {
        // Invalid role
        exit("Invalid role");
    }

    // Replace salary with X's based on its length
    $salary = str_repeat('X', strlen($salary_plain));

    // Prepare and execute the SQL query to insert staff details
    $query = "INSERT INTO $table (username, contact, age, salary, salary_plain, duty) VALUES (?, ?, ?, ?, ?, ?)";
    $statement = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($statement, "ssisss", $username, $contact, $age, $salary, $salary_plain, $duty);
    $result = mysqli_stmt_execute($statement);

    if ($result) {
        // Redirect to appropriate staff page after successful insertion
        if ($role === "Wedding Staff") {
            header("Location: wedding_staff.php");
        } elseif ($role === "Catering Staff") {
            header("Location: catering_staff.php");
        }
        exit; // Ensure to exit after redirection
    } else {
        // Handle error
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Add Staff</title>
</head>
<body>
    <div class="container">
        <h1>Add Staff</h1>
        <form action="add_staff.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label">Contact:</label>
                <input type="text" class="form-control" id="contact" name="contact" required>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age:</label>
                <input type="number" class="form-control" id="age" name="age" required>
            </div>
            <div class="mb-3">
                <label for="salary" class="form-label">Salary:</label>
                <input type="number" class="form-control" id="salary" name="salary" required>
            </div>
            <div class="mb-3">
                <label for="duty" class="form-label">Duty:</label>
                <input type="text" class="form-control" id="duty" name="duty" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role:</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="">Select Role</option>
                    <option value="Wedding Staff">Wedding Staff</option>
                    <option value="Catering Staff">Catering Staff</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Staff</button>
            <a href="index.php" class="btn btn-primary">Cancel</a>
        </form>
    </div>
</body>
</html>
