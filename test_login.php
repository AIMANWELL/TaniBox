<?php
require 'config/database.php';

$username = "admin";
$password = "password"; // Password yang ingin diuji

$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

if (!$query) {
    die("Query Error: " . mysqli_error($conn));
}

$user = mysqli_fetch_assoc($query);

echo "<h2>Data User</h2>";

echo "<pre>";
print_r($user);
echo "</pre>";

echo "<hr>";

if (!$user) {

    echo "<h2 style='color:red'>User tidak ditemukan!</h2>";

} else {

    if (password_verify($password, $user['password'])) {

        echo "<h2 style='color:green'>✅ PASSWORD COCOK</h2>";

    } else {

        echo "<h2 style='color:red'>❌ PASSWORD TIDAK COCOK</h2>";

    }

}
?>