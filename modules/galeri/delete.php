<?php

include '../../includes/session.php';
require '../../config/database.php';


$id=$_GET['id'];



$data=mysqli_query($conn,"
SELECT * FROM galeri WHERE id='$id'
");


$row=mysqli_fetch_assoc($data);



if(file_exists("../../".$row['url_file'])){

unlink("../../".$row['url_file']);

}



mysqli_query($conn,"
DELETE FROM galeri
WHERE id='$id'
");



header("Location:index.php");

exit;