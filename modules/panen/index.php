<?php
include '../../includes/session.php';
require '../../config/database.php';

$query = mysqli_query($conn,"
SELECT
    panen.*,
    tanaman.nama_tanaman
FROM panen
LEFT JOIN tanaman
ON panen.tanaman_id = tanaman.id
ORDER BY panen.id DESC
");

include '../../includes/header.php';
?>

<?php include '../../includes/navbar.php'; ?>

<div class="container-fluid">

<div class="row">

<div class="col-md-2 p-0">
<?php include '../../includes/sidebar.php'; ?>
</div>

<div class="col-md-10 content">

<div class="d-flex justify-content-between align-items-center mb-4">

<h3>🌾 Data Panen</h3>

<a href="tambah.php" class="btn btn-success">
+ Tambah Panen
</a>

</div>

<table id="datatable" class="table table-bordered table-striped">

<thead class="table-success">

<tr>

<th>No</th>
<th>Tanaman</th>
<th>Tanggal</th>
<th>Berat</th>
<th>Harga/Kg</th>
<th>Total</th>
<th>Catatan</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

while($row=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++ ?></td>

<td><?= htmlspecialchars($row['nama_tanaman']) ?></td>

<td><?= $row['tanggal_panen'] ?></td>

<td><?= number_format($row['berat'],2) ?> Kg</td>

<td>
Rp <?= number_format($row['harga_perkg'],0,',','.') ?>
</td>

<td>
Rp <?= number_format($row['total_hasil'],0,',','.') ?>
</td>

<td><?= htmlspecialchars($row['catatan']) ?></td>

<td>

<a
href="edit.php?id=<?= $row['id'] ?>"
class="btn btn-warning btn-sm">

Edit

</a>

<button
class="btn btn-danger btn-sm"
onclick="hapusData(<?= $row['id']; ?>)">

Hapus

</button>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

<script>

function hapusData(id){

Swal.fire({

title:'Hapus Data Panen?',

text:'Data yang dihapus tidak dapat dikembalikan.',

icon:'warning',

showCancelButton:true,

confirmButtonColor:'#198754',

cancelButtonColor:'#dc3545',

confirmButtonText:'Ya',

cancelButtonText:'Batal'

}).then((result)=>{

if(result.isConfirmed){

window.location='hapus.php?id='+id;

}

});

}

</script>

<?php include '../../includes/footer.php'; ?>