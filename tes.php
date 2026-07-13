<?php
require 'config/database.php';

$status = mysqli_query($conn,"
SELECT status, COUNT(*) AS jumlah
FROM tanaman
GROUP BY status
");

$label = [];
$data = [];

while($row = mysqli_fetch_assoc($status)){

    $label[] = $row['status'];
    $data[] = $row['jumlah'];

}

echo "<pre>";
print_r($label);
print_r($data);
echo "</pre>";