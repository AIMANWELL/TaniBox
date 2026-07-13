<?php
include '../../includes/session.php';
require '../../config/database.php';

if(isset($_POST['simpan'])){

    $tanaman_id    = $_POST['tanaman_id'];
    $tanggal       = $_POST['tanggal_panen'];
    $berat         = $_POST['berat'];
    $harga_perkg   = $_POST['harga_perkg'];
    $catatan       = mysqli_real_escape_string($conn,$_POST['catatan']);

    $total = $berat * $harga_perkg;

    mysqli_query($conn,"INSERT INTO panen
    (tanaman_id,tanggal_panen,berat,harga_perkg,total_hasil,catatan)
    VALUES
    ('$tanaman_id','$tanggal','$berat','$harga_perkg','$total','$catatan')
    ");

    header("Location:index.php");
    exit;
}

$tanaman = mysqli_query($conn,"SELECT * FROM tanaman");

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
<h4>🌾 Tambah Data Panen</h4>
</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">
<label>Tanaman</label>

<select name="tanaman_id" class="form-control" required>

<?php while($t=mysqli_fetch_assoc($tanaman)){ ?>

<option value="<?= $t['id']; ?>">
<?= $t['nama_tanaman']; ?>
</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Tanggal Panen</label>

<input
type="date"
name="tanggal_panen"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Berat (Kg)</label>

<input
type="number"
step="0.01"
name="berat"
id="berat"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Harga per Kg (Rp)</label>

<input
type="number"
name="harga_perkg"
id="harga"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Total Hasil (Rp)</label>

<input
type="text"
id="total"
class="form-control"
readonly>

</div>

<div class="mb-3">

<label>Catatan</label>

<textarea
name="catatan"
class="form-control"
rows="3"></textarea>

</div>

<button
class="btn btn-success"
name="simpan">

Simpan

</button>

<a href="index.php" class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

</div>

</div>

<script>

function hitungTotal(){

    let berat = parseFloat(document.getElementById('berat').value) || 0;

    let harga = parseFloat(document.getElementById('harga').value) || 0;

    document.getElementById('total').value =
        (berat * harga).toLocaleString('id-ID');

}

document.getElementById('berat').addEventListener('keyup', hitungTotal);

document.getElementById('harga').addEventListener('keyup', hitungTotal);

</script>

<?php include '../../includes/footer.php'; ?>