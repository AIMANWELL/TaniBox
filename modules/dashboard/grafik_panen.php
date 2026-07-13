<?php
require 'config/database.php';

$query = mysqli_query($conn,"
SELECT
MONTH(tanggal_panen) AS bulan,
SUM(berat) AS berat
FROM panen
GROUP BY MONTH(tanggal_panen)
ORDER BY MONTH(tanggal_panen)
");

$namaBulan=[
1=>"Jan",2=>"Feb",3=>"Mar",4=>"Apr",
5=>"Mei",6=>"Jun",7=>"Jul",8=>"Agu",
9=>"Sep",10=>"Okt",11=>"Nov",12=>"Des"
];

$data=[];

while($row=mysqli_fetch_assoc($query)){

$data['bulan'][]=$namaBulan[$row['bulan']];
$data['berat'][]=$row['berat'];

}

header('Content-Type: application/json');

echo json_encode($data);