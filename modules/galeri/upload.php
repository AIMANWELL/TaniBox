<?php
include '../../includes/session.php';
require '../../config/database.php';

include '../../includes/header.php';
include '../../includes/navbar.php';


if(isset($_POST['upload'])){

    $tanaman_id = $_POST['tanaman_id'];

    $file = $_FILES['gambar'];

    $nama_file = time().'_'.$file['name'];
    $tmp_file  = $file['tmp_name'];
    $tipe_file = $file['type'];


    $folder = "../../uploads/galeri/";

    $path = $folder.$nama_file;


    if(move_uploaded_file($tmp_file,$path)){


        $url_file = "uploads/galeri/".$nama_file;


        mysqli_query($conn,"
            INSERT INTO galeri
            (
                tanaman_id,
                nama_file,
                url_file,
                tipe_file
            )
            VALUES
            (
                '$tanaman_id',
                '$nama_file',
                '$url_file',
                '$tipe_file'
            )
        ");


        echo "
        <script>
        alert('Upload berhasil');
        window.location='index.php';
        </script>";

    }

}

?>


<div class="container-fluid">

<div class="row">


<div class="col-md-2 p-0">
<?php include '../../includes/sidebar.php'; ?>
</div>


<div class="col-md-10 content">


<h3 class="mb-4">
Upload Foto Galeri
</h3>


<form method="POST" enctype="multipart/form-data">


<div class="mb-3">

<label>
Tanaman
</label>

<select name="tanaman_id" class="form-control" required>

<option value="">
-- Pilih Tanaman --
</option>


<?php

$t = mysqli_query($conn,"SELECT * FROM tanaman");

while($data=mysqli_fetch_assoc($t)){

?>

<option value="<?= $data['id']; ?>">

<?= $data['nama_tanaman']; ?>

</option>


<?php } ?>


</select>

</div>


<div class="mb-3">

<label>
Foto
</label>

<input
type="file"
name="gambar"
class="form-control"
required>

</div>


<button
name="upload"
class="btn btn-success">

Upload

</button>


<a href="index.php"
class="btn btn-secondary">

Kembali

</a>


</form>


</div>


</div>

</div>


<?php include '../../includes/footer.php'; ?>