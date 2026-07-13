<?php
include '../../includes/session.php';
require '../../config/database.php';

$id = $_GET['id'];

$data = mysqli_query($conn,"SELECT * FROM tanaman WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

if(!$row){
    die("Data tidak ditemukan.");
}

if(isset($_POST['update'])){

    $nama      = mysqli_real_escape_string($conn,$_POST['nama_tanaman']);
    $jenis     = mysqli_real_escape_string($conn,$_POST['jenis_tanaman']);
    $lokasi    = mysqli_real_escape_string($conn,$_POST['lokasi']);
    $luas      = $_POST['luas_lahan'];
    $tglTanam  = $_POST['tanggal_tanam'];
    $tglPanen  = $_POST['estimasi_panen'];
    $status    = $_POST['status'];

    $foto = $row['foto'];

    if(isset($_FILES['foto']) && $_FILES['foto']['error']==0){

        if($foto != "" && file_exists("../../uploads/tanaman/".$foto)){
            unlink("../../uploads/tanaman/".$foto);
        }

        $namaFoto = time()."_".$_FILES['foto']['name'];

        move_uploaded_file(
            $_FILES['foto']['tmp_name'],
            "../../uploads/tanaman/".$namaFoto
        );

        $foto = $namaFoto;
    }

    mysqli_query($conn,"UPDATE tanaman SET

        nama_tanaman='$nama',
        jenis_tanaman='$jenis',
        lokasi='$lokasi',
        luas_lahan='$luas',
        tanggal_tanam='$tglTanam',
        estimasi_panen='$tglPanen',
        status='$status',
        foto='$foto'

        WHERE id='$id'
    ");

    echo "<script>

    alert('Data berhasil diubah');

    window.location='index.php';

    </script>";

    exit;
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

<div class="card">

<div class="card-header bg-success text-white">

<h4>Edit Data Tanaman</h4>

</div>

<div class="card-body">

<form method="POST" enctype="multipart/form-data">

<div class="row">

<div class="col-md-6 mb-3">

<label>Nama Tanaman</label>

<input
type="text"
name="nama_tanaman"
class="form-control"
value="<?= $row['nama_tanaman']; ?>"
required>

</div>

<div class="col-md-6 mb-3">

<label>Jenis Tanaman</label>

<input
type="text"
name="jenis_tanaman"
class="form-control"
value="<?= $row['jenis_tanaman']; ?>"
required>

</div>

<div class="col-md-6 mb-3">

<label>Lokasi</label>

<input
type="text"
name="lokasi"
class="form-control"
value="<?= $row['lokasi']; ?>"
required>

</div>

<div class="col-md-6 mb-3">

<label>Luas Lahan</label>

<input
type="number"
step="0.01"
name="luas_lahan"
class="form-control"
value="<?= $row['luas_lahan']; ?>">

</div>

<div class="col-md-6 mb-3">

<label>Tanggal Tanam</label>

<input
type="date"
name="tanggal_tanam"
class="form-control"
value="<?= $row['tanggal_tanam']; ?>">

</div>

<div class="col-md-6 mb-3">

<label>Estimasi Panen</label>

<input
type="date"
name="estimasi_panen"
class="form-control"
value="<?= $row['estimasi_panen']; ?>">

</div>

<div class="col-md-6 mb-3">

<label>Status</label>

<select name="status" class="form-control">

<option value="Proses Tanam" <?= ($row['status']=="Proses Tanam")?'selected':''; ?>>Proses Tanam</option>

<option value="Tumbuh" <?= ($row['status']=="Tumbuh")?'selected':''; ?>>Tumbuh</option>

<option value="Panen" <?= ($row['status']=="Panen")?'selected':''; ?>>Panen</option>

</select>

</div>

<div class="col-md-6 mb-3">

<label>Ganti Foto</label>

<input
type="file"
name="foto"
class="form-control"
accept="image/*"
onchange="previewImage(event)">

</div>

<div class="col-md-12 mb-3">

<?php if($row['foto']!=""){ ?>

<img
src="../../uploads/tanaman/<?= $row['foto']; ?>"
id="preview"
class="img-thumbnail"
style="max-width:200px;">

<?php } else { ?>

<img
id="preview"
style="display:none;max-width:200px;"
class="img-thumbnail">

<?php } ?>

</div>

<div class="col-md-12">

<button
class="btn btn-success"
name="update">

Update

</button>

<a
href="index.php"
class="btn btn-secondary">

Kembali

</a>

</div>

</div>

</form>

</div>

</div>

</div>

</div>

</div>

<script>

function previewImage(event){

const img=document.getElementById('preview');

img.src=URL.createObjectURL(event.target.files[0]);

img.style.display='block';

}

</script>

<?php include '../../includes/footer.php'; ?>