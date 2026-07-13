<div class="sidebar">

    <div class="text-center text-white py-3">
        <img src="/TaniBox/assets/img/tanibox_logo.svg" alt="TaniBox" style="width:56px;height:56px;margin-bottom:6px;" />
        <h3 class="mt-0 mb-0">TaniBox</h3>
        <div class="small opacity-75">Admin Panel</div>
    </div>

    <a href="/TaniBox/dashboard.php">
        <i class="bi bi-graph-up-arrow"></i>
        Dashboard
    </a>

    <a href="/TaniBox/modules/tanaman">
        <i class="bi bi-flower2"></i>
        Data Tanaman
    </a>

    <a href="/TaniBox/modules/panen">
        <i class="bi bi-bag-check-fill"></i>
        Data Panen
    </a>

    <a href="/TaniBox/modules/galeri">
        <i class="bi bi-camera2"></i>
        Galeri
    </a>

    <?php if ($_SESSION['role'] == 'admin') { ?>

    <a href="/TaniBox/modules/users">
        <i class="bi bi-person-badge-fill"></i>
        Users
    </a>

    <?php } ?>

    <a href="/TaniBox/logout.php">
        <i class="bi bi-box-arrow-left"></i>
        Logout
    </a>

</div>