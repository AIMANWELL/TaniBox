<?php

include '../../includes/session.php';
require '../../config/database.php';


$id=$_GET['id'];


$data=mysqli_query($conn,"
SELECT * FROM users WHERE id='$id'
");


$user=mysqli_fetch_assoc($data);



if(isset($_POST['update'])){


$nama=$_POST['nama'];

$username=$_POST['username'];

$role=$_POST['role'];



mysqli_query($conn,"
UPDATE users SET

nama='$nama',

username='$username',

role='$role'

WHERE id='$id'

");



if(!empty($_POST['password'])){


$password=password_hash(
$_POST['password'],
PASSWORD_DEFAULT
);


mysqli_query($conn,"
UPDATE users SET

password='$password'

WHERE id='$id'
");


}



header("Location:index.php");

}



include '../../includes/header.php';

?>


<div class="container mt-4">


<h3>Edit User</h3>


<form method="POST">


<input 
type="text"
name="nama"
class="form-control mb-3"
value="<?= $user['nama']; ?>">



<input
type="text"
name="username"
class="form-control mb-3"
value="<?= $user['username']; ?>">



<input
type="password"
name="password"
class="form-control mb-3"
placeholder="Kosongkan jika tidak diganti">



<select name="role"
class="form-control mb-3">


<option value="admin"
<?= $user['role']=='admin'?'selected':''; ?>>

Admin

</option>


<option value="petugas"
<?= $user['role']=='petugas'?'selected':''; ?>>

Petugas

</option>


</select>



<button name="update"
class="btn btn-success">

Update

</button>


</form>


</div>


<?php include '../../includes/footer.php'; ?>