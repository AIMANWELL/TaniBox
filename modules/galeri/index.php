<?php
include '../../includes/session.php';
require '../../config/database.php';


$query = "
SELECT 
    galeri.*,
    tanaman.nama_tanaman

FROM galeri

LEFT JOIN tanaman 
ON galeri.tanaman_id = tanaman.id

ORDER BY galeri.id DESC
";


$data = mysqli_query($conn,$query);


if(!$data){
    die("Query gagal : ".mysqli_error($conn));
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


<div class="d-flex justify-content-between align-items-center mb-4">


<h3 class="fw-bold text-success">

🖼 Galeri Tanaman

</h3>


<a href="upload.php" class="btn btn-success">

+ Upload Foto

</a>


</div>




<table id="datatable" 
class="table table-bordered table-striped table-hover align-middle">


<thead class="table-success text-center">


<tr>

<th width="60">No</th>

<th>Tanaman</th>

<th>Foto</th>

<th>Nama File</th>

<th>Tanggal Upload</th>

<th width="220">Aksi</th>

</tr>


</thead>



<tbody>


<?php


if(mysqli_num_rows($data)>0){


$no=1;


while($row=mysqli_fetch_assoc($data)){


?>


<tr>


<td class="text-center">

<?= $no++; ?>

</td>



<td>

<?= htmlspecialchars($row['nama_tanaman'] ?? 'Tidak ada'); ?>

</td>



<td class="text-center">


<?php if(!empty($row['url_file'])){ ?>


<a href="../../<?= $row['url_file']; ?>" target="_blank">


<img

src="../../<?= $row['url_file']; ?>"

width="120"

class="img-thumbnail"

alt="gambar">


</a>


<?php }else{ ?>


<span class="text-muted">

Tidak ada foto

</span>


<?php } ?>


</td>




<td>

<?= htmlspecialchars($row['nama_file']); ?>

</td>




<td class="text-center">

<?= htmlspecialchars($row['created_at']); ?>

</td>




<td class="text-center">


<a

href="download.php?id=<?= $row['id']; ?>"

class="btn btn-primary btn-sm">

Download

</a>



<a

href="edit.php?id=<?= $row['id']; ?>"

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


<?php


}


}else{


?>


<tr>

<td colspan="6" class="text-center">

Belum ada foto galeri.

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


title:'Hapus Foto?',


text:'Data foto akan dihapus permanen.',


icon:'warning',


showCancelButton:true,


confirmButtonColor:'#198754',


cancelButtonColor:'#dc3545',


confirmButtonText:'Ya, Hapus',


cancelButtonText:'Batal'


}).then((result)=>{


if(result.isConfirmed){


window.location='delete.php?id='+id;


}


});


}


</script>



<?php include '../../includes/footer.php'; ?>