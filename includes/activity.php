<?php
session_start();

require 'config/database.php';
require 'includes/activity.php';

if (!$conn) {
    die("Koneksi database gagal.");
}

if (isset($_POST['login'])) {

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username = ?");

    mysqli_stmt_bind_param($stmt, "s", $username);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {

        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {

            session_regenerate_id(true);

            $_SESSION['login'] = true;
            $_SESSION['id']    = $user['id'];
            $_SESSION['nama']  = $user['nama'];
            $_SESSION['role']  = $user['role'];

            // Simpan aktivitas login
            simpanLog(
                $conn,
                $user['nama'],
                "Login ke sistem"
            );

            header("Location: dashboard.php");
            exit;

        } else {

            $error = "Password salah.";

        }

    } else {

        $error = "Username tidak ditemukan.";

    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Login TaniBox</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/login.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body class="bg-light">

<div class="container">

<div class="row justify-content-center align-items-center vh-100">

<div class="col-md-4">

<div class="card shadow">

<div class="card-header text-center bg-success text-white">

<img src="assets/img/logo.png" width="80" class="mb-2">

<h3>TaniBox</h3>

<p class="mb-0">Smart Agriculture Management System</p>

</div>

<div class="card-body">

<?php if(isset($error)){ ?>

<div class="alert alert-danger">

<?= $error; ?>

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
required>

</div>

<div class="mb-3">

<label class="form-label">

<i class="fa fa-lock"></i>

Password

</label>

<input
type="password"
name="password"
class="form-control"
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

</div>

<div class="card-footer text-center">

© <?= date('Y'); ?> TaniBox

</div>

</div>

</div>

</div>

</div>

</body>

</html>