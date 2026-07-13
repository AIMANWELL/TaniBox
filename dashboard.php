<?php
include 'includes/session.php';
require 'config/database.php';

/* ===========================
   TOTAL DATA
=========================== */

$total_tanaman = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM tanaman"))['total'];
$total_panen   = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM panen"))['total'];
$total_galeri  = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM galeri"))['total'];
$total_user    = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM users"))['total'];

/* ===========================
   STATUS TANAMAN
=========================== */

$status = mysqli_query($conn,"
SELECT status, COUNT(*) AS jumlah
FROM tanaman
GROUP BY status
");

$label_status = [];
$data_status  = [];

while($row = mysqli_fetch_assoc($status)){
    $label_status[] = $row['status'];
    $data_status[]  = (int)$row['jumlah'];
}

/* ===========================
   TOTAL PANEN
=========================== */

$q = mysqli_query($conn,"
SELECT
SUM(berat) AS total_berat,
SUM(total_hasil) AS total_hasil
FROM panen
");

$hasil = mysqli_fetch_assoc($q);

$total_berat = $hasil['total_berat'] ?? 0;
$total_hasil = $hasil['total_hasil'] ?? 0;

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container-fluid">

<div class="row">

<div class="col-md-2 p-0">
<?php include 'includes/sidebar.php'; ?>
</div>

<div class="col-md-10 content">

<div class="db-hero mb-4">
  <div class="db-title">
    <div>
      <h2 class="mb-1 text-success fw-bold">🌾 Dashboard TaniBox</h2>
      <div class="text-muted">Ringkasan cepat data tanaman, panen, galeri, dan user</div>
    </div>
    <span class="badge-soft ms-auto">Live Overview</span>
  </div>
</div>

<div class="row g-3">

  <div class="col-md-3">
    <div class="db-stat-card card bg-success text-white h-100">
      <div class="db-stat-bg" style="background: rgba(255,255,255,.35);"></div>
      <div class="card-body position-relative">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <div class="text-white-50 fw-semibold">🌱 Tanaman</div>
            <div class="db-stat-value"><?= $total_tanaman ?></div>
          </div>
          <div class="db-stat-icon">
            <i class="bi bi-tree-fill"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="db-stat-card card bg-primary text-white h-100">
      <div class="db-stat-bg" style="background: rgba(255,255,255,.35);"></div>
      <div class="card-body position-relative">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <div class="text-white-50 fw-semibold">🌾 Panen</div>
            <div class="db-stat-value"><?= $total_panen ?></div>
          </div>
          <div class="db-stat-icon">
            <i class="bi bi-basket2-fill"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="db-stat-card card bg-warning text-dark h-100">
      <div class="db-stat-bg" style="background: rgba(0,0,0,.12);"></div>
      <div class="card-body position-relative">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <div class="text-black-50 fw-semibold">🖼 Galeri</div>
            <div class="db-stat-value"><?= $total_galeri ?></div>
          </div>
          <div class="db-stat-icon bg-white bg-opacity-25">
            <i class="bi bi-images"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="db-stat-card card bg-dark text-white h-100">
      <div class="db-stat-bg" style="background: rgba(255,255,255,.20);"></div>
      <div class="card-body position-relative">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <div class="text-white-50 fw-semibold">👥 User</div>
            <div class="db-stat-value"><?= $total_user ?></div>
          </div>
          <div class="db-stat-icon">
            <i class="bi bi-people-fill"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<div class="row mt-3 g-3">

<div class="col-md-4">
<div class="card shadow">
<div class="card-body">
<h6>Total Berat Panen</h6>
<h3><?= number_format($total_berat,2) ?> Kg</h3>
</div>
</div>
</div>

<div class="col-md-4">
<div class="card shadow">
<div class="card-body">
<h6>Total Pendapatan</h6>
<h3>Rp <?= number_format($total_hasil,0,',','.') ?></h3>
</div>
</div>
</div>

<div class="col-md-4">
<div class="card shadow">
<div class="card-header bg-primary text-white">
Cloud Status
</div>
<div class="card-body">
<p>Amazon S3 :
<span class="badge bg-warning">Waiting</span>
</p>

<p>Amazon EC2 :
<span class="badge bg-warning">Waiting</span>
</p>
</div>
</div>
</div>

</div>

<div class="row mt-4 g-3">

  <div class="col-md-6">
    <div class="card shadow db-card">
      <div class="card-header bg-success text-white">
        <div class="d-flex align-items-center justify-content-between">
          <span>Status Tanaman</span>
          <span class="badge bg-light text-dark">Live</span>
        </div>
      </div>
      <div class="card-body" style="height:350px;">
        <canvas id="statusChart"></canvas>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card shadow db-card">
      <div class="card-header bg-primary text-white">
        <div class="d-flex align-items-center justify-content-between">
          <span>Panen Bulanan</span>
          <span class="badge bg-light text-dark" id="panenBadge">Data</span>
        </div>
      </div>
      <div class="card-body" style="height:350px;">
        <canvas id="panenChart"></canvas>
      </div>
    </div>
  </div>

</div>

</div>

</div>

</div>

<script>

const statusCtx = document.getElementById('statusChart');

if (statusCtx) {
  const labels = <?= json_encode($label_status); ?>;
  const dataStatus = <?= json_encode($data_status); ?>;

  const baseColors = ['#198754', '#ffc107', '#0d6efd', '#dc3545', '#6f42c1', '#20c997', '#fd7e14'];
  const backgroundColors = labels.map((_, i) => baseColors[i % baseColors.length]);

  new Chart(statusCtx, {
    type: 'doughnut',
    data: {
      labels,
      datasets: [{
        label: 'Status',
        data: dataStatus,
        backgroundColor: backgroundColors,
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false
    }
  });
}

const panenCtx = document.getElementById('panenChart');

if (panenCtx) {
  fetch('grafik_panen.php')
    .then(response => response.json())
    .then(result => {
      const bulan = result.bulan || [];
      const berat = result.berat || [];

      const panenBadge = document.getElementById('panenBadge');
      if (panenBadge) {
        panenBadge.textContent = berat.length ? 'Tersedia' : 'Kosong';
        panenBadge.classList.toggle('bg-success', berat.length > 0);
        panenBadge.classList.toggle('bg-danger', berat.length === 0);
        panenBadge.classList.toggle('text-white', true);
      }

      new Chart(panenCtx, {
        type: 'bar',
        data: {
          labels: bulan,
          datasets: [{
            label: 'Berat Panen (Kg)',
            data: berat,
            backgroundColor: '#0d6efd',
            borderRadius: 10
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            tooltip: {
              callbacks: {
                label: function(context) {
                  const v = context.parsed.y ?? 0;
                  return ` ${v} Kg`;
                }
              }
            }
          },
          scales: {
            y: { beginAtZero: true }
          }
        }
      });
    })
    .catch(error => {
      console.log(error);
    });
}

</script>

<?php include 'includes/footer.php'; ?>