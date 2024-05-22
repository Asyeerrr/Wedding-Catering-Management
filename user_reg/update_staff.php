<?php
session_start();

// Check if the user is logged in and has the required role
if (!isset($_SESSION["user"]) || $_SESSION["role"] !== "Admin") {
    header("Location: index.php");
    exit; // Ensure to exit after redirection
}

// Include your database connection file
require_once "database.php";

// Initialize variables
$id = $_GET['id'];
$table = $_GET['table'];
$username = $contact = $age = $salary_plain = $duty = "";

// Validate the table name
if ($table !== "cater_staff" && $table !== "wed_staff") {
    echo "Invalid table specified.";
    exit;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $contact = $_POST["contact"];
    $age = $_POST["age"];
    $salary_plain = $_POST["salary"];
    $duty = $_POST["duty"];

    // Replace salary with X's based on its length
    $salary = str_repeat('X', strlen($salary_plain));

    // Prepare and execute the update query
    $query = "UPDATE $table SET username = ?, contact = ?, age = ?, salary = ?, salary_plain = ?, duty = ? WHERE staff_id = ?";
    $statement = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($statement, "ssisssi", $username, $contact, $age, $salary, $salary_plain, $duty, $id);
    $result = mysqli_stmt_execute($statement);

    if ($result) {
        // Redirect to the referring page after successful update
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit; // Ensure to exit after redirection
    } else {
        // Handle error
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Fetch current details of the staff member
    $query = "SELECT * FROM $table WHERE staff_id = ?";
    $statement = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($statement, "i", $id);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);

    if ($row = mysqli_fetch_assoc($result)) {
        $username = $row['username'];
        $contact = $row['contact'];
        $age = $row['age'];
        $salary_plain = $row['salary_plain'];
        $duty = $row['duty'];
    } else {
        echo "No staff member found with the specified ID.";
        exit;
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
    <title>Update Staff</title>
</head>
<body>
    <div class="container">
        <h1>Update Staff</h1>
        <form action="update_staff.php?id=<?= $id ?>&table=<?= $table ?>" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= $username ?>" required>
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label">Contact:</label>
                <input type="text" class="form-control" id="contact" name="contact" value="<?= $contact ?>" required>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age:</label>
                <input type="number" class="form-control" id="age" name="age" value="<?= $age ?>" required>
            </div>
            <div class="mb-3">
                <label for="salary" class="form-label">Salary:</label>
                <input type="number" class="form-control" id="salary" name="salary" value="<?= $salary_plain ?>" required>
            </div>
            <div class="mb-3">
                <label for="duty" class="form-label">Duty:</label>
                <input type="text" class="form-control" id="duty" name="duty" value="<?= $duty ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Staff</button>
            <a href="index.php" class="btn btn-primary">Done</a>
        </form>
    </div>
</body>
</html>
