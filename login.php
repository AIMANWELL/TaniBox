<?php
session_start();
require 'config/database.php';

if(isset($_POST['login'])){

    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = $_POST['password'];

    $query = mysqli_query($conn,"
        SELECT * FROM users
        WHERE username='$username'
    ");

    $user = mysqli_fetch_assoc($query);

    if($user && password_verify($password,$user['password'])){

        $_SESSION['login']=true;
        $_SESSION['id']=$user['id'];
        $_SESSION['nama']=$user['nama'];
        $_SESSION['role']=$user['role'];

        header("Location: dashboard.php");
        exit;

    }else{

        $error="Username atau Password salah.";

    }

}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>TaniBox Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/login.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

<div class="card login-card">

<div class="card-header">

<img src="assets/img/logo.png"
class="logo">

<h2>TaniBox</h2>

<p>Smart Agriculture Management System</p>

</div>

<div class="card-body">

<?php if(isset($error)){ ?>

<div class="alert alert-danger">

<?= $error ?>

</div>

<?php } ?>

<form method="POST">

<div class="mb-3">

<label class="form-label">

<i class="fa fa-user"></i>

Username

</label>

<input
type="text"
name="username"
class="form-control"
placeholder="Masukkan Username"
required>

</div>

<div class="mb-4">

<label class="form-label">

<i class="fa fa-lock"></i>

Password

</label>

<input
type="password"
name="password"
class="form-control"
placeholder="Masukkan Password"
required>

</div>

<button
type="submit"
name="login"
class="btn btn-success w-100">

<i class="fa fa-right-to-bracket"></i>

Login

</button>

</form>

<div class="footer">

© <?= date('Y') ?> TaniBox<br>

Cloud Computing Project

</div>

</div>

</div>

</body>

</html>