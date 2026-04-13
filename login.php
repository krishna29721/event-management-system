<?php
session_start();
include "db.php";

$message = "";

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $res = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$pass'");
    
    if(mysqli_num_rows($res) > 0){
        $_SESSION['user'] = $email;
        $message = "<div class='alert alert-success text-center'>Login Successful! Redirecting...</div>";

        echo "<script>
        setTimeout(function(){
            window.location.href = 'dashboard.php';
        }, 1500);
        </script>";
    } else {
        $message = "<div class='alert alert-danger text-center'>Invalid Email or Password</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: linear-gradient(135deg, #e3f2fd, #f1f8ff);
    height: 100vh;
}

.login-card {
    background: white;
    border-radius: 15px;
    padding: 35px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

input {
    border-radius: 10px !important;
    padding: 10px;
}

h2 {
    font-weight: bold;
}

.btn-login {
    background: #0d6efd;
    border: none;
}

.btn-login:hover {
    background: #0b5ed7;
}

.link-text a {
    text-decoration: none;
}
</style>
</head>

<body>

<div class="container d-flex justify-content-center align-items-center" style="height:100vh;">

<div class="col-md-4 login-card">

<h2 class="text-center text-primary mb-4">Login</h2>
<p class="text-muted text-center">
Your Smart Event Management Platform
</p>

<?php echo $message; ?>

<form method="POST">

<input type="email" name="email" placeholder="Email" class="form-control mb-3" required>

<input type="password" name="password" placeholder="Password" class="form-control mb-3" required>

<button name="login" class="btn btn-login w-100 text-white">
Login
</button>

</form>

<br>

<p class="text-center link-text">
Don't have an account? 
<a href="register.php" class="text-primary">Register</a>
</p>

</div>

</div>
<footer class="text-center mt-5 p-3 bg-primary text-white">
    <p class="mb-0">
        © 2026 Eventify | Designed by Krishna Garg
    </p>
</footer>
</body>
</html>