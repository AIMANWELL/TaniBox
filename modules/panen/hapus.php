<?php
include '../../includes/session.php';
require '../../config/database.php';

if(!isset($_GET['id'])){
    header("Location:index.php");
    exit;
}

$id = intval($_GET['id']);

$query = mysqli_query($conn,"DELETE FROM panen WHERE id='$id'");

if($query){

    header("Location:index.php");

}else{

    die(mysqli_error($conn));

}
?>