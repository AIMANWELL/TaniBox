<?php
require 'config/database.php';

$passwordBaru = 'admin123';
$hash = password_hash($passwordBaru, PASSWORD_DEFAULT);

$sql = "UPDATE users SET password=? WHERE username='admin'";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $hash);

if (mysqli_stmt_execute($stmt)) {
    echo "<h2>Password admin berhasil direset</h2>";
    echo "<p>Username : <b>admin</b></p>";
    echo "<p>Password : <b>admin123</b></p>";
    echo "<hr>";
    echo "<pre>$hash</pre>";
} else {
    echo mysqli_error($conn);
}