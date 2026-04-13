<?php
session_start();
include "db.php";

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

$email = $_SESSION['user'];

$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM users WHERE email='$email'"));
$user_id = $user['id'];

$res = mysqli_query($conn, "
SELECT events.title, events.date, events.location, events.type, events.price
FROM registrations
JOIN events ON registrations.event_id = events.id
WHERE registrations.user_id = $user_id
");
?>

<!DOCTYPE html>
<html>
<head>
<title>My Registrations</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: linear-gradient(135deg, #e3f2fd, #f1f8ff);
    color: #333;
}

.card-custom {
    background: white;
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    transition: 0.3s;
}

.card-custom:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

h2 {
    font-weight: bold;
}
</style>
</head>

<body>

<div class="container mt-5">

<h2 class="text-center text-primary mb-4">My Registered Events</h2>

<div class="row">

<?php
if(mysqli_num_rows($res) == 0){
    echo "<h4 class='text-center text-dark'>No Registrations Found</h4>";
}

while($row = mysqli_fetch_assoc($res)){
?>

<div class="col-md-4 mb-3">
    <div class="card-custom">

        <h4 class="text-primary"><?php echo $row['title']; ?></h4>

        <p><b>Date:</b> <?php echo $row['date']; ?></p>
        <p><b>Location:</b> <?php echo $row['location']; ?></p>

        <!-- 🔥 EXTRA DETAILS -->
        <p class="text-info"><b>Type:</b> <?php echo $row['type']; ?></p>
        <p class="text-success"><b>Paid:</b> ₹<?php echo $row['price']; ?></p>

    </div>
</div>

<?php } ?>

</div>

</div>
<footer class="text-center mt-5 p-3 bg-primary text-white">
    <p class="mb-0">
        © 2026 Eventify | Designed by Krishna Garg
    </p>
</footer>

</body>
</html>