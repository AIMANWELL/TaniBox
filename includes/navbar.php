<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">

    <div class="container-fluid">

        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="/TaniBox/dashboard.php">

            <img src="/TaniBox/assets/img/tanibox_logo.svg" alt="TaniBox" class="me-1" style="width:38px;height:38px;filter: drop-shadow(0 8px 18px rgba(0,0,0,.18));" />
            <span class="d-flex flex-column lh-1">
                <span class="fs-5">TaniBox</span>
                <span class="small opacity-75">Smart Agriculture</span>
            </span>

        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarTaniBox">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarTaniBox">

            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item me-3">

                    <span class="text-white">

                        <i class="bi bi-person-circle"></i>

                        Selamat Datang,

                        <strong><?= htmlspecialchars($_SESSION['nama']); ?></strong>

                        <span class="badge bg-light text-success ms-1">

                            <?= strtoupper(htmlspecialchars($_SESSION['role'])); ?>

                        </span>

                    </span>

                </li>

                <li class="nav-item">

                    <a href="/TaniBox/logout.php" class="btn btn-outline-light btn-sm">

                        <i class="bi bi-box-arrow-right"></i>

                        Logout

                    </a>

                </li>

            </ul>

        </div>

    </div>

</nav>