<?php
session_start();
include "db.php";

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

/* 🔍 SEARCH LOGIC */
$search = "";

if(isset($_GET['search'])){
    $search = $_GET['search'];
    $res = mysqli_query($conn, "SELECT * FROM events WHERE title LIKE '%$search%'");
} else {
    $res = mysqli_query($conn, "SELECT * FROM events");
}

/* DELETE EVENT */
if(isset($_GET['delete'])){
    $id = intval($_GET['delete']);

    $stmt = $conn->prepare("DELETE FROM events WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: events.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Events</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: linear-gradient(135deg, #e3f2fd, #f1f8ff);
}

.card {
    border-radius: 15px;
    transition: 0.3s;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}
</style>

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-primary">
  <div class="container">
    <span class="navbar-brand">Event Management System</span>
  </div>
</nav>

<div class="container mt-5">

<h2 class="text-center mb-4 text-primary">All Events</h2>

<!-- 🔍 SEARCH BOX -->
<form method="GET" class="mb-4 text-center">
    <input type="text" name="search" value="<?php echo $search; ?>" placeholder="Search events..." class="form-control w-50 d-inline">
    <button class="btn btn-primary">Search</button>
</form>

<div class="row">

<?php
if(mysqli_num_rows($res) == 0){
    echo "<div class='col-12 text-center'><h4 class='text-dark'>No Events Found</h4></div>";
}

while($row = mysqli_fetch_assoc($res)){
?>
<div class="col-md-4">

    <div class="card bg-white text-dark mb-4 p-3 shadow">

        <h4 class="text-primary"><?php echo $row['title']; ?></h4>

        <p><b>Date:</b> <?php echo $row['date']; ?></p>
        <p><b>Location:</b> <?php echo $row['location']; ?></p>

        <!-- 🔥 NEW DATA -->
        <p class="text-info"><b>Type:</b> <?php echo $row['type']; ?></p>
        <p class="text-success"><b>Price:</b> ₹<?php echo $row['price']; ?></p>
        <p class="text-warning"><b>Seats:</b> <?php echo $row['capacity']; ?></p>

        <!-- ACTION BUTTONS -->
        <a href="event_details.php?id=<?php echo $row['id']; ?>" class="btn btn-info mt-2 w-100">
        View
        </a>

        <a href="edit_event.php?id=<?php echo $row['id']; ?>" class="btn btn-warning mt-2 w-100">
        Edit
        </a>

        <a href="events.php?delete=<?php echo $row['id']; ?>" 
        class="btn btn-danger mt-2 w-100"
        onclick="return confirm('Are you sure you want to delete this event?')">
        Delete
        </a>

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