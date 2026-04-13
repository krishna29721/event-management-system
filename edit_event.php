<?php
session_start();
include "db.php";

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

$id = intval($_GET['id']);

$res = mysqli_query($conn, "SELECT * FROM events WHERE id=$id");
$event = mysqli_fetch_assoc($res);

if(isset($_POST['update'])){
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $date = $_POST['date'];
    $loc = $_POST['location'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $capacity = $_POST['capacity'];

    mysqli_query($conn, "UPDATE events 
        SET title='$title', description='$desc', date='$date', location='$loc',
            price='$price', type='$type', capacity='$capacity'
        WHERE id=$id
    ");

    header("Location: events.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Event</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: linear-gradient(135deg, #e3f2fd, #f1f8ff);
}

.card {
    border-radius: 15px;
}
</style>
</head>

<body>

<div class="container mt-5">

<div class="card p-4 shadow bg-white text-dark">

<h2 class="text-primary mb-3">Edit Event</h2>

<form method="POST">

<input type="text" name="title" value="<?php echo $event['title']; ?>" class="form-control mb-3" required>

<textarea name="description" class="form-control mb-3" required><?php echo $event['description']; ?></textarea>

<input type="date" name="date" value="<?php echo $event['date']; ?>" class="form-control mb-3" required>

<input type="text" name="location" value="<?php echo $event['location']; ?>" class="form-control mb-3" required>

<!-- 🔥 NEW FIELDS -->
<input type="number" name="price" value="<?php echo $event['price']; ?>" class="form-control mb-3" placeholder="Ticket Price" required>

<select name="type" class="form-control mb-3" required>
    <option <?php if($event['type']=="Conference") echo "selected"; ?>>Conference</option>
    <option <?php if($event['type']=="Workshop") echo "selected"; ?>>Workshop</option>
    <option <?php if($event['type']=="Meetup") echo "selected"; ?>>Meetup</option>
</select>

<input type="number" name="capacity" value="<?php echo $event['capacity']; ?>" class="form-control mb-3" placeholder="Max Seats" required>

<button name="update" class="btn btn-success w-100">
Update Event
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