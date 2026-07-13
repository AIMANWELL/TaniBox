<?php
include '../../includes/session.php';
require '../../config/database.php';

// ===========================
// TOTAL DATA
// ===========================

$total_tanaman = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) total FROM tanaman"))['total'];

$total_panen = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) total FROM panen"))['total'];

$total_galeri = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) total FROM galeri"))['total'];

// ===========================
// STATUS TANAMAN
// ===========================

$status = mysqli_query($conn,"
SELECT status,COUNT(*) jumlah
FROM tanaman
GROUP BY status
");

$label=[];
$data=[];

while($row=mysqli_fetch_assoc($status)){

    $label[]=$row['status'];
    $data[]=(int)$row['jumlah'];

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

<div>

<h2 class="fw-bold text-success">
🌾 Dashboard Petugas
</h2>

<p class="text-muted">
Selamat datang,
<strong><?= $_SESSION['nama']; ?></strong>
</p>

</div>

<div class="text-end">

<small><?= date('d F Y'); ?></small><br>

<span class="badge bg-success">

<?= strtoupper($_SESSION['role']); ?>

</span>

</div>

</div>

<div class="row">

<div class="col-lg-4 mb-4">

<div class="card shadow border-0 rounded-4">

<div class="card-body text-center">

<i class="bi bi-tree-fill text-success fs-1"></i>

<h6 class="mt-2">Total Tanaman</h6>

<h2><?= $total_tanaman ?></h2>

</div>

</div>

</div>

<div class="col-lg-4 mb-4">

<div class="card shadow border-0 rounded-4">

<div class="card-body text-center">

<i class="bi bi-basket2-fill text-warning fs-1"></i>

<h6 class="mt-2">Total Panen</h6>

<h2><?= $total_panen ?></h2>

</div>

</div>

</div>

<div class="col-lg-4 mb-4">

<div class="card shadow border-0 rounded-4">

<div class="card-body text-center">

<i class="bi bi-images text-primary fs-1"></i>

<h6 class="mt-2">Total Galeri</h6>

<h2><?= $total_galeri ?></h2>

</div>

</div>

</div>

</div>

<div class="row">

<div class="col-lg-6 mb-4">

<div class="card shadow border-0">

<div class="card-header bg-success text-white">

Status Tanaman

</div>

<div class="card-body" style="height:350px">

<canvas id="statusChart"></canvas>

</div>

</div>

</div>

<div class="col-lg-6 mb-4">

<div class="card shadow border-0">

<div class="card-header bg-primary text-white">

Panen Bulanan

</div>

<div class="card-body" style="height:350px">

<canvas id="panenChart"></canvas>

</div>

</div>

</div>

</div>

<div class="row">

<div class="col-lg-12">

<div class="card shadow border-0">

<div class="card-header bg-dark text-white">

Status Sistem

</div>

<div class="card-body">

<div class="row">

<div class="col-md-3">

Database<br>

<span class="badge bg-success">Connected</span>

</div>

<div class="col-md-3">

Local Storage<br>

<span class="badge bg-success">Aktif</span>

</div>

<div class="col-md-3">

Amazon S3<br>

<span class="badge bg-warning">Waiting</span>

</div>

<div class="col-md-3">

Amazon EC2<br>

<span class="badge bg-warning">Waiting</span>

</div>

</div>

<hr>

PHP Version :
<b><?= phpversion(); ?></b>

</div>

</div>

</div>

</div>

</div>

</div>

</div>

<?php include '../../includes/footer.php'; ?>

<script>

window.onload=function(){

// =========================
// STATUS TANAMAN
// =========================

const ctx=document.getElementById("statusChart");

if(ctx){

new Chart(ctx,{

type:'doughnut',

data:{

labels:<?= json_encode($label); ?>,

datasets:[{

data:<?= json_encode($data); ?>,

backgroundColor:[
'#198754',
'#ffc107',
'#0d6efd',
'#dc3545',
'#6f42c1'
]

}]

},

options:{

responsive:true,

maintainAspectRatio:false,

plugins:{

legend:{

position:'bottom'

}

}

}

});

}

// =========================
// PANEN BULANAN
// =========================

const panen=document.getElementById("panenChart");

if(panen){

fetch("/TaniBox/grafik_panen.php")

.then(res=>res.json())

.then(result=>{

new Chart(panen,{

type:'bar',

data:{

labels:result.bulan,

datasets:[{

label:'Berat Panen (Kg)',

data:result.berat,

backgroundColor:'#0d6efd'

}]

},

options:{

responsive:true,

maintainAspectRatio:false,

scales:{

y:{

beginAtZero:true

}

}

}

});

});

}

}

</script>