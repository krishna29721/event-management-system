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
<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
body {
    background: linear-gradient(135deg, #e0f7fa, #e1f5fe);
    color: #333;
}

/* CARD DESIGN */
.card-box {
    background: white;
    border-radius: 18px;
    padding: 30px;
    text-align: center;
    transition: 0.3s;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    border: none;
}

/* HOVER EFFECT */
.card-box:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.2);
}

/* ICON STYLE */
.icon {
    font-size: 60px;
    margin-bottom: 15px;
    color: #0288d1;
}

/* HEADING */
h2 {
    font-weight: bold;
    color: #01579b;
}
</style>
</head>

<body>

<div class="container mt-5 text-center">
<?php include "config.php"; ?>

<h2 class="text-<?php echo $primary_color; ?>">
<?php echo $site_name; ?>
</h2>
<h2 style="color:#0d47a1; font-weight:bold;">
Welcome <?php echo $_SESSION['user']; ?>
</h2>
<p class="text-muted text-center">
Your Smart Event Management Platform
</p>

<div class="row g-4">

<!-- CREATE EVENT -->
<div class="col-md-4">
    <a href="create_event.php" style="text-decoration:none;">
    <div class="card-box">
        <div class="icon"><i class="fas fa-calendar-plus"></i></div>
        <h4>Create Event</h4>
        <p>Add new events</p>
    </div>
    </a>
</div>

<!-- VIEW EVENTS -->
<div class="col-md-4">
    <a href="events.php" style="text-decoration:none;">
    <div class="card-box">
        <div class="icon"><i class="fas fa-calendar"></i></div>
        <h4>View Events</h4>
        <p>Browse all events</p>
    </div>
    </a>
</div>

<!-- MY REGISTRATIONS -->
<div class="col-md-4">
    <a href="my_registrations.php" style="text-decoration:none;">
    <div class="card-box">
        <div class="icon"><i class="fas fa-list-check"></i></div>
        <h4>My Registrations</h4>
        <p>Events you joined</p>
    </div>
    </a>
</div>

</div>

<br><br>

<!-- LOGOUT BUTTON -->
<a href="logout.php" class="btn btn-danger btn-lg">
    <i class="fas fa-sign-out-alt"></i> Logout
</a>

</div>
<footer class="text-center mt-5 p-3 bg-primary text-white">
    <p class="mb-0">
        © 2026 Eventify | Designed by Krishna Garg
    </p>
</footer>
</body>
</html>