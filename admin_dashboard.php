<?php
session_start();
include "db.php";

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

// TOTAL USERS
$users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users"));

// TOTAL EVENTS
$events = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM events"));

// TOTAL REGISTRATIONS
$regs = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM registrations"));
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

<div class="container mt-5 text-center">

<h2 class="text-warning mb-4">Admin Dashboard</h2>

<div class="row">

<div class="col-md-4">
    <div class="card bg-primary text-white p-3">
        <h3>Total Users</h3>
        <h1><?php echo $users['total']; ?></h1>
    </div>
</div>

<div class="col-md-4">
    <div class="card bg-success text-white p-3">
        <h3>Total Events</h3>
        <h1><?php echo $events['total']; ?></h1>
    </div>
</div>

<div class="col-md-4">
    <div class="card bg-danger text-white p-3">
        <h3>Total Registrations</h3>
        <h1><?php echo $regs['total']; ?></h1>
    </div>
</div>

</div>

<br>

<a href="dashboard.php" class="btn btn-light mt-3">Back to Dashboard</a>

</div>
<footer class="text-center mt-5 p-3 bg-primary text-white">
    <p class="mb-0">
        © 2026 Eventify | Designed by Krishna Garg
    </p>
</footer>
</body>
</html>