<?php

include '../../includes/session.php';
require '../../config/database.php';

$data = mysqli_query($conn, "SELECT * FROM tanaman ORDER BY id DESC");

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

                <h3>🌱 Data Tanaman</h3>

                <a href="tambah.php" class="btn btn-success">
                    + Tambah Data
                </a>

            </div>

            <table id="datatable" class="table table-bordered table-striped">

                <thead class="table-success">

                    <tr>
                        <th width="60">No</th>
                        <th>Nama Tanaman</th>
                        <th>Jenis</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th width="170">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    <?php

                    if(mysqli_num_rows($data) > 0){

                        $no = 1;

                        while($row = mysqli_fetch_assoc($data)){

                    ?>

                    <tr>

                        <td><?= $no++; ?></td>

                        <td><?= htmlspecialchars($row['nama_tanaman']); ?></td>

                        <td><?= htmlspecialchars($row['jenis_tanaman']); ?></td>

                        <td><?= htmlspecialchars($row['lokasi']); ?></td>

                        <td>

                            <?php

                            if($row['status']=="Proses Tanam"){

                                echo "<span class='badge bg-warning text-dark'>Proses Tanam</span>";

                            }elseif($row['status']=="Tumbuh"){

                                echo "<span class='badge bg-success'>Tumbuh</span>";

                            }elseif($row['status']=="Panen"){

                                echo "<span class='badge bg-primary'>Panen</span>";

                            }else{

                                echo "<span class='badge bg-secondary'>".$row['status']."</span>";

                            }

                            ?>

                        </td>

                        <td>

                            <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <button
                                type="button"
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
                            Belum ada data tanaman.
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

        title: 'Hapus Data?',

        text: 'Data yang dihapus tidak dapat dikembalikan!',

        icon: 'warning',

        showCancelButton: true,

        confirmButtonColor: '#198754',

        cancelButtonColor: '#dc3545',

        confirmButtonText: 'Ya, Hapus',

        cancelButtonText: 'Batal'

    }).then((result) => {

        if(result.isConfirmed){

            window.location.href = "hapus.php?id=" + id;

        }

    });

}

</script>

<?php include '../../includes/footer.php'; ?>