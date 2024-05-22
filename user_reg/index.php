<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head content -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Wedding & Catering Management</title>
    <style>
        .container-top {
            margin-top: 50px;
            text-align: center;
        }
        .btn-center {
            display: block;
            margin: 10px auto;
        }
    </style>
</head>
<body>
    <div class="container container-top">
        <h1>Wedding & Catering Management</h1>
        <a href="logout.php" class="btn btn-warning btn-center">Logout</a>

        <?php if (isset($_SESSION["role"]) && $_SESSION["role"] == "Admin") : ?>
            <a href="add_staff.php" class="btn btn-primary btn-center">Add Staff</a>
        <?php endif; ?>

        <?php if (isset($_SESSION["role"]) && ($_SESSION["role"] == "Admin" || $_SESSION["role"] == "Wedding Manager")) : ?>
            <a href="wedding_staff.php" class="btn btn-primary btn-center">Wedding Staff</a>
        <?php endif; ?>

        <?php if (isset($_SESSION["role"]) && ($_SESSION["role"] == "Admin" || $_SESSION["role"] == "Catering Manager")) : ?>
            <a href="catering_staff.php" class="btn btn-primary btn-center">Catering Staff</a>
        <?php endif; ?>
    </div>
</body>
</html>
