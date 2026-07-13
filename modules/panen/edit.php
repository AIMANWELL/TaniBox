<?php
include '../../includes/session.php';
require '../../config/database.php';

if (!isset($_GET['id'])) {
    header("Location:index.php");
    exit;
}

$id = intval($_GET['id']);

$data = mysqli_query($conn, "SELECT * FROM panen WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

if (!$row) {
    die("Data tidak ditemukan.");
}

if (isset($_POST['update'])) {

    $tanaman_id   = $_POST['tanaman_id'];
    $tanggal      = $_POST['tanggal_panen'];
    $berat        = $_POST['berat'];
    $harga_perkg  = $_POST['harga_perkg'];
    $catatan      = mysqli_real_escape_string($conn,$_POST['catatan']);

    $total = $berat * $harga_perkg;

    mysqli_query($conn,"UPDATE panen SET

        tanaman_id='$tanaman_id',
        tanggal_panen='$tanggal',
        berat='$berat',
        harga_perkg='$harga_perkg',
        total_hasil='$total',
        catatan='$catatan'

        WHERE id='$id'
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

<div class="card-header bg-warning">

<h4>Edit Data Panen</h4>

</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label>Tanaman</label>

<select name="tanaman_id" class="form-control">

<?php while($t=mysqli_fetch_assoc($tanaman)){ ?>

<option
value="<?= $t['id']; ?>"
<?= ($row['tanaman_id']==$t['id'])?'selected':''; ?>>

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
value="<?= $row['tanggal_panen']; ?>">

</div>

<div class="mb-3">

<label>Berat (Kg)</label>

<input
type="number"
step="0.01"
id="berat"
name="berat"
class="form-control"
value="<?= $row['berat']; ?>">

</div>

<div class="mb-3">

<label>Harga per Kg</label>

<input
type="number"
id="harga"
name="harga_perkg"
class="form-control"
value="<?= $row['harga_perkg']; ?>">

</div>

<div class="mb-3">

<label>Total Hasil</label>

<input
type="text"
id="total"
class="form-control"
readonly
value="<?= number_format($row['total_hasil'],0,',','.'); ?>">

</div>

<div class="mb-3">

<label>Catatan</label>

<textarea
name="catatan"
class="form-control"
rows="4"><?= $row['catatan']; ?></textarea>

</div>

<button
class="btn btn-success"
name="update">

Update

</button>

<a href="index.php"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

</div>

</div>

<script>

function hitung(){

let berat=parseFloat(document.getElementById('berat').value)||0;

let harga=parseFloat(document.getElementById('harga').value)||0;

let total=berat*harga;

document.getElementById('total').value=
total.toLocaleString('id-ID');

}

document.getElementById('berat').addEventListener('keyup',hitung);

document.getElementById('harga').addEventListener('keyup',hitung);

</script>

<?php include '../../includes/footer.php'; ?>