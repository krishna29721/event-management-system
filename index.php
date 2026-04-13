<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

<div class="container text-center mt-5">

<h1 class="text-warning">Event Management System</h1>

<p class="mt-3">Welcome to your project dashboard</p>

<a href="dashboard.php" class="btn btn-success m-2">Go to Dashboard</a>
<a href="events.php" class="btn btn-info m-2">View Events</a>
<a href="logout.php" class="btn btn-danger m-2">Logout</a>

</div>
<footer class="text-center mt-5 p-3 bg-primary text-white">
    <p class="mb-0">
        © 2026 Eventify | Designed by Krishna Garg
    </p>
</footer>
</body>
</html>