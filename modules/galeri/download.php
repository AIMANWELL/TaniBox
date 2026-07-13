<?php

require '../../config/database.php';


$id=$_GET['id'];



$data=mysqli_query($conn,"
SELECT * FROM galeri WHERE id='$id'
");


$row=mysqli_fetch_assoc($data);



$file="../../".$row['url_file'];



if(file_exists($file)){


header('Content-Description: File Transfer');

header('Content-Type: '.$row['tipe_file']);

header('Content-Disposition: attachment; filename="'.$row['nama_file'].'"');

header('Content-Length: '.filesize($file));


readfile($file);

exit;


}else{


echo "File tidak ditemukan";


}