<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

include "db.php";

$id = intval($_GET['id']);

$res = mysqli_query($conn, "SELECT * FROM events WHERE id=$id");
$row = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html>
<head>
<title>Event Details</title>
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

<?php
if($row){
?>

<div class="card p-4 shadow bg-white text-dark">

<h2 class="text-primary"><?php echo $row['title']; ?></h2>

<p><b>Description:</b> <?php echo $row['description']; ?></p>
<p><b>Date:</b> <?php echo $row['date']; ?></p>
<p><b>Location:</b> <?php echo $row['location']; ?></p>

<!-- 🔥 NEW DATA -->
<p class="text-info"><b>Type:</b> <?php echo $row['type']; ?></p>
<p class="text-success"><b>Price:</b> ₹<?php echo $row['price']; ?></p>
<p class="text-warning"><b>Seats Available:</b> <?php echo $row['capacity']; ?></p>

<form method="POST">
    <button name="join" class="btn btn-success mt-3">
        Pay ₹<?php echo $row['price']; ?> & Register
    </button>
</form>

<?php
// 🔥 REGISTER LOGIC (UPDATED)
if(isset($_POST['join'])){

    $email = $_SESSION['user'];

    $u = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT id FROM users WHERE email='$email'")
    );

    $user_id = $u['id'];

    // 🔢 COUNT CURRENT REGISTRATIONS
    $count = mysqli_fetch_assoc(mysqli_query($conn, 
    "SELECT COUNT(*) AS total FROM registrations WHERE event_id=$id"));

    // 🚫 CHECK CAPACITY
    if($count['total'] < $row['capacity']){

        // ❌ CHECK DUPLICATE
        $check = mysqli_query($conn, 
        "SELECT * FROM registrations WHERE user_id=$user_id AND event_id=$id");

        if(mysqli_num_rows($check) == 0){

            mysqli_query($conn, 
            "INSERT INTO registrations (user_id,event_id) VALUES ($user_id,$id)");

            // ✅ SUCCESS MESSAGE
            echo "<div class='alert alert-success mt-3'>
            Payment Successful ✅ <br>
            You are registered for this event! <br>
            Confirmation email sent (demo)
            </div>";

        } else {
            echo "<div class='alert alert-warning mt-3'>Already Registered</div>";
        }

    } else {
        echo "<div class='alert alert-danger mt-3'>Event Full!</div>";
    }
}
?>

</div>

<?php
} else {
    echo "<h4 class='text-danger'>Event not found</h4>";
}
?>

</div>
<footer class="text-center mt-5 p-3 bg-primary text-white">
    <p class="mb-0">
        © 2026 Eventify | Designed by Krishna Garg
    </p>
</footer>
</body>
</html>