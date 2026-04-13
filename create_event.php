<?php
session_start();
include "db.php";

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['create'])){
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $date = $_POST['date'];
    $loc = $_POST['location'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $capacity = $_POST['capacity'];

    mysqli_query($conn, "INSERT INTO events (title,description,date,location,price,type,capacity) 
    VALUES ('$title','$desc','$date','$loc','$price','$type','$capacity')");

    echo "<script>alert('Event Created Successfully');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Create Event</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: linear-gradient(135deg, #f0f8ff, #e3f2fd);
    color: #333;
}

.card-custom {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

input, textarea, select {
    margin-bottom: 15px;
    border-radius: 10px !important;
}
</style>
</head>

<body>

<div class="container mt-5 d-flex justify-content-center">

<div class="col-md-6 card-custom">

<h2 class="text-center text-primary mb-4">Create New Event</h2>

<form method="POST">

<input type="text" name="title" class="form-control" placeholder="Event Title" required>

<textarea name="description" class="form-control" placeholder="Event Description" rows="3"></textarea>

<input type="date" name="date" class="form-control" required>

<input type="text" name="location" class="form-control" placeholder="Location">

<!-- NEW FIELDS -->
<input type="number" name="price" class="form-control" placeholder="Ticket Price (₹)" required>

<select name="type" class="form-control" required>
    <option value="">Select Event Type</option>
    <option>Conference</option>
    <option>Workshop</option>
    <option>Meetup</option>
</select>

<input type="number" name="capacity" class="form-control" placeholder="Max Seats" required>

<button name="create" class="btn btn-success w-100 mt-3">
Create Event
</button>

</form>

</div>

</div>
<footer class="text-center mt-5 p-3 bg-primary text-white">
    <p class="mb-0">
        © 2026 Eventify | Designed by Krishna Garg
    </p>
</footer>
</body>
</html>