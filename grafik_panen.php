<?php
require 'config/database.php';

$bulan = [];
$berat = [];

$namaBulan = [
    1 => "Jan",
    2 => "Feb",
    3 => "Mar",
    4 => "Apr",
    5 => "Mei",
    6 => "Jun",
    7 => "Jul",
    8 => "Agu",
    9 => "Sep",
    10 => "Okt",
    11 => "Nov",
    12 => "Des"
];

$query = mysqli_query($conn, "
SELECT
    MONTH(tanggal_panen) AS bulan,
    SUM(berat) AS total
FROM panen
GROUP BY MONTH(tanggal_panen)
ORDER BY MONTH(tanggal_panen)
");

while($row = mysqli_fetch_assoc($query)){

    $bulan[] = $namaBulan[(int)$row['bulan']];
    $berat[] = (float)$row['total'];

}

header('Content-Type: application/json');

echo json_encode([
    "bulan" => $bulan,
    "berat" => $berat
]);