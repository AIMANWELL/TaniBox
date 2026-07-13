<?php

if($_SESSION['role']!='admin'){

echo "
<script>
alert('Akses hanya untuk admin');
window.location='/TaniBox/dashboard.php';
</script>
";

exit;

}

?>