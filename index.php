<?php
require 'config/database.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TaniBox</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header bg-success text-white text-center">

                    <h2>🌾 TaniBox</h2>

                    <p class="mb-0">Smart Agriculture Management System</p>

                </div>

                <div class="card-body text-center">

                    <?php if($conn){ ?>

                        <div class="alert alert-success">

                            <h5>✔ Koneksi Database Berhasil</h5>

                            Database <strong>tanibox_db</strong> berhasil terhubung.

                        </div>

                    <?php } else { ?>

                        <div class="alert alert-danger">

                            <h5>✖ Koneksi Database Gagal</h5>

                            Silakan periksa file <strong>config/database.php</strong>

                        </div>

                    <?php } ?>

                    <a href="login.php" class="btn btn-success">

                        Login ke Dashboard

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>