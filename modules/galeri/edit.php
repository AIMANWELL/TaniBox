<?php
include '../../includes/session.php';
require '../../config/database.php';


$id = $_GET['id'];


$query = mysqli_query($conn,"
SELECT * FROM galeri WHERE id='$id'
");


$data = mysqli_fetch_assoc($query);



if(isset($_POST['update'])){


$tanaman_id = $_POST['tanaman_id'];



if($_FILES['gambar']['name']!=""){


    $file = $_FILES['gambar'];

    $nama_file = time().'_'.$file['name'];

    $tmp = $file['tmp_name'];

    $tipe = $file['type'];



    move_uploaded_file(
        $tmp,
        "../../uploads/galeri/".$nama_file
    );



    // hapus file lama

    if(file_exists("../../".$data['url_file'])){

        unlink("../../".$data['url_file']);

    }



    $url_file="uploads/galeri/".$nama_file;



    mysqli_query($conn,"
    UPDATE galeri SET

    tanaman_id='$tanaman_id',
    nama_file='$nama_file',
    url_file='$url_file',
    tipe_file='$tipe'

    WHERE id='$id'
    ");



}else{


    mysqli_query($conn,"
    UPDATE galeri SET

    tanaman_id='$tanaman_id'

    WHERE id='$id'
    ");


}



echo "
<script>
alert('Data berhasil diubah');
window.location='index.php';
</script>
";


}



include '../../includes/header.php';
include '../../includes/navbar.php';

?>


<div class="container-fluid">

<div class="row">


<div class="col-md-2 p-0">

<?php include '../../includes/sidebar.php'; ?>

</div>



<div class="col-md-10 content">


<h3 class="mb-4">
Edit Galeri
</h3>



<form method="POST" enctype="multipart/form-data">


<div class="mb-3">

<label>
Tanaman
</label>


<select name="tanaman_id" class="form-control">


<?php

$t=mysqli_query($conn,"
SELECT * FROM tanaman
");


while($tanaman=mysqli_fetch_assoc($t)){


?>


<option

value="<?= $tanaman['id']; ?>"

<?= ($tanaman['id']==$data['tanaman_id'])?'selected':''; ?>

>


<?= $tanaman['nama_tanaman']; ?>


</option>


<?php } ?>


</select>

</div>




<div class="mb-3">


<label>
Foto Sekarang
</label>

<br>


<img

src="../../<?= $data['url_file']; ?>"

width="150"

class="img-thumbnail">


</div>




<div class="mb-3">


<label>
Ganti Foto
</label>


<input

type="file"

name="gambar"

class="form-control">


</div>



<button

name="update"

class="btn btn-success">

Simpan Perubahan

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