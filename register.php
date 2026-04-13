<?php
include "db.php";

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    mysqli_query($conn, "INSERT INTO users (name,email,password) VALUES ('$name','$email','$pass')");
    echo "Registered Successfully! <a href='login.php'>Login</a>";
}
?>

<h2>Register</h2>
<form method="POST">
<input type="text" name="name" placeholder="Name" required><br><br>
<input type="email" name="email" placeholder="Email" required><br><br>
<input type="password" name="password" placeholder="Password" required><br><br>
<button name="submit">Register</button>
</form>