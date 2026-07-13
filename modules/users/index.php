<?php
include '../../includes/session.php';
require '../../config/database.php';

// Proteksi: hanya admin yang boleh mengakses
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo "<script>
            alert('Akses ditolak!');
            window.location='../../dashboard.php';
          </script>";
    exit;
}

$data = mysqli_query($conn,"
SELECT * FROM users
ORDER BY id DESC
");

include '../../includes/header.php';
include '../../includes/navbar.php';
?>

<div class="container-fluid">

<div class="row">

<div class="col-md-2 p-0">
<?php include '../../includes/sidebar.php'; ?>
</div>

<div class="col-md-10 content">

<div class="d-flex justify-content-between align-items-center mb-4">

<h3 class="fw-bold text-success">
<i class="bi bi-people-fill"></i> Data Users
</h3>

<a href="tambah.php" class="btn btn-success">
<i class="bi bi-plus-circle"></i> Tambah User
</a>

</div>

<table id="datatable" class="table table-bordered table-striped table-hover align-middle">

<thead class="table-success">

<tr>

<th width="60">No</th>
<th>Nama</th>
<th>Username</th>
<th>Role</th>
<th>Tanggal Dibuat</th>
<th width="180">Aksi</th>

</tr>

</thead>

<tbody>

<?php
$no=1;

while($row=mysqli_fetch_assoc($data)){
?>

<tr>

<td><?= $no++; ?></td>

<td><?= htmlspecialchars($row['nama']); ?></td>

<td><?= htmlspecialchars($row['username']); ?></td>

<td>

<?php if($row['role']=="admin"){ ?>

<span class="badge bg-danger">
Admin
</span>

<?php }else{ ?>

<span class="badge bg-primary">
Petugas
</span>

<?php } ?>

</td>

<td><?= $row['created_at']; ?></td>

<td>

<a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">
<i class="bi bi-pencil-square"></i> Edit
</a>

<button onclick="hapusUser(<?= $row['id']; ?>)" class="btn btn-danger btn-sm">
<i class="bi bi-trash"></i> Hapus
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

function hapusUser(id){

Swal.fire({

title:'Hapus User?',

text:'Data user akan dihapus permanen.',

icon:'warning',

showCancelButton:true,

confirmButtonColor:'#198754',

cancelButtonColor:'#dc3545',

confirmButtonText:'Ya, Hapus',

cancelButtonText:'Batal'

}).then((result)=>{

if(result.isConfirmed){

window.location='hapus.php?id='+id;

}

});

}

</script>

<?php include '../../includes/footer.php'; ?>