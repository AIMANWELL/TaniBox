<?php

include '../../includes/session.php';
require '../../config/database.php';


if(isset($_POST['simpan'])){


$nama=$_POST['nama'];

$username=$_POST['username'];

$password=password_hash($_POST['password'],PASSWORD_DEFAULT);

$role=$_POST['role'];



mysqli_query($conn,"
INSERT INTO users

(nama,username,password,role)

VALUES

('$nama','$username','$password','$role')

");



echo "
<script>
alert('User berhasil ditambahkan');
window.location='index.php';
</script>";

}



include '../../includes/header.php';
include '../../includes/navbar.php';

?>


<div class="container mt-4">


<h3>
Tambah User
</h3>


<form method="POST">


<div class="mb-3">

<label>Nama</label>

<input 
type="text"
name="nama"
class="form-control"
required>

</div>



<div class="mb-3">

<label>Username</label>

<input
type="text"
name="username"
class="form-control"
required>

</div>



<div class="mb-3">

<label>Password</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>



<div class="mb-3">

<label>Role</label>


<select name="role"
class="form-control">


<option value="admin">
Admin
</option>


<option value="petugas">
Petugas
</option>


</select>


</div>


<button name="simpan"
class="btn btn-success">

Simpan

</button>


<a href="index.php"
class="btn btn-secondary">

Kembali

</a>


</form>


</div>


<?php include '../../includes/footer.php'; ?>