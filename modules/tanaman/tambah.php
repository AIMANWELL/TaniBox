<?php
include '../../includes/session.php';
require '../../config/database.php';

if(isset($_POST['simpan'])){

    $nama       = mysqli_real_escape_string($conn,$_POST['nama_tanaman']);
    $jenis      = mysqli_real_escape_string($conn,$_POST['jenis_tanaman']);
    $lokasi     = mysqli_real_escape_string($conn,$_POST['lokasi']);
    $luas       = $_POST['luas_lahan'];
    $tglTanam   = $_POST['tanggal_tanam'];
    $tglPanen   = $_POST['estimasi_panen'];
    $status     = $_POST['status'];

    $foto = "";

    if(isset($_FILES['foto']) && $_FILES['foto']['error']==0){

        $namaFoto = time()."_".$_FILES['foto']['name'];

        move_uploaded_file(
            $_FILES['foto']['tmp_name'],
            "../../uploads/tanaman/".$namaFoto
        );

        $foto = $namaFoto;
    }

    $query = mysqli_query($conn,"INSERT INTO tanaman
    (nama_tanaman,jenis_tanaman,lokasi,luas_lahan,tanggal_tanam,estimasi_panen,status,foto)
    VALUES
    ('$nama','$jenis','$lokasi','$luas','$tglTanam','$tglPanen','$status','$foto')
    ");

    if($query){
        echo "<script>
            alert('Data berhasil ditambahkan');
            window.location='index.php';
        </script>";
        exit;
    }else{
        echo "<div class='alert alert-danger'>".mysqli_error($conn)."</div>";
    }
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
<h4>🌱 Tambah Data Tanaman</h4>
</div>

<div class="card-body">

<form method="POST" enctype="multipart/form-data">

<div class="row">

<div class="col-md-6 mb-3">
<label>Nama Tanaman</label>
<input type="text" name="nama_tanaman" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label>Jenis Tanaman</label>
<input type="text" name="jenis_tanaman" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label>Lokasi</label>
<input type="text" name="lokasi" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label>Luas Lahan (Ha)</label>
<input type="number" step="0.01" name="luas_lahan" class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Tanggal Tanam</label>
<input type="date" name="tanggal_tanam" class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Estimasi Panen</label>
<input type="date" name="estimasi_panen" class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Status</label>
<select name="status" class="form-control">
<option value="Proses Tanam">Proses Tanam</option>
<option value="Tumbuh">Tumbuh</option>
<option value="Panen">Panen</option>
</select>
</div>

<div class="col-md-6 mb-3">
<label>Foto Tanaman</label>
<input type="file" name="foto" class="form-control" accept="image/*" onchange="previewImage(event)">
</div>

<div class="col-md-12 mb-3">
<img id="preview" src="" style="max-width:200px;display:none;" class="img-thumbnail">
</div>

<div class="col-md-12">

<button class="btn btn-success" name="simpan">
<i class="bi bi-save"></i> Simpan
</button>

<a href="index.php" class="btn btn-secondary">
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