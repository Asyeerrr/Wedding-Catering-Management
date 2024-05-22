<?php
session_start();
if (!isset($_SESSION["user"]) || $_SESSION["role"] == "Catering Manager") {
    header("Location: index.php");
    exit; // Ensure to exit after redirection
}

// Include your database connection file
require_once "database.php";

// Fetch wedding staff details from the database
$query = "SELECT * FROM wed_staff";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Wedding Staff</title>
</head>
<body>
    <div class="container">
        <h1>Wedding Staff</h1>
        <table class="table">
        <thead>
                <tr>
                    <th>Staff ID</th>
                    <th>Username</th>
                    <th>Contact</th>
                    <th>Age</th>
                    <th>Salary</th>
                    <th>Duty</th>
                    <?php if ($_SESSION["role"] === "Admin") : ?>
                        <th>Action</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?= $row['staff_id']; ?></td>
                        <td><?= $row['username']; ?></td>
                        <td><?= $row['contact']; ?></td>
                        <td><?= $row['age']; ?></td>
                        <td>
                            <?php
                            if ($_SESSION["role"] === "Admin") {
                                echo $row['salary_plain'];
                            } else {
                                echo $row['salary'];
                            }
                            ?>
                        </td>
                        <td><?= $row['duty']; ?></td>
                        <?php if ($_SESSION["role"] === "Admin") : ?>
                            <td>
                                <a href="delete_staff.php?id=<?= $row['staff_id']; ?>" class="btn btn-danger">Del</a>
                                <a href="update_staff.php?id=<?= $row['staff_id']; ?>&table=wed_staff" class="btn btn-primary">Upd</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-primary">Home</a>
    </div>
</body>
</html>

