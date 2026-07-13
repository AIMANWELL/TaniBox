<?php
include '../../includes/session.php';
require '../../config/database.php';

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan.");
}

$id = intval($_GET['id']);

// Ambil data tanaman
$result = mysqli_query($conn, "SELECT * FROM tanaman WHERE id = $id");

if (mysqli_num_rows($result) == 0) {
    die("Data tidak ditemukan.");
}

$data = mysqli_fetch_assoc($result);

// Hapus foto jika ada
if (!empty($data['foto'])) {

    $file = "../../uploads/tanaman/" . $data['foto'];

    if (file_exists($file)) {
        unlink($file);
    }
}

// Hapus data
$hapus = mysqli_query($conn, "DELETE FROM tanaman WHERE id = $id");

if ($hapus) {

    header("Location: index.php?status=hapus");
    exit;

} else {

    die("Error MySQL : " . mysqli_error($conn));

}
?>