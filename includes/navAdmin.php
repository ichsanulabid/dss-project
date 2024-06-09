<!-- between card-header and card-body -->
<!-- <div class="row mt-1">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <div class="card shadow">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link" href="../admin/admin.php">Home</a>
                            <a class="nav-link" href="../admin/userView.php">User</a>
                            <a class="nav-link" href="../login/adminLogout.php">Keluar</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="col-lg-1"></div>
</div> -->

<!-- Header -->
<?php include '../includes/header.php' ?>

<style>
    .navbar {
        padding: 0;
    }
    .navbar-brand img {
        max-height: 60px; 
        margin-right: 10px; 
    }
    .navbar-nav {
        margin-left: auto;
    }
    .navbar-nav .nav-link {
        padding: 1rem;
    }
</style>

<div class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <!-- System Name -->
        <a class="navbar-brand" href="#">
            <img src="..\img\logo-unram.png" alt="Logo">Admin Panel - Indonesia Pintar Scholarship Program Recipient Recommendation
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Menu -->
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <!-- Navigation Links -->
                <a class="nav-link" href="../admin/admin.php">Home</a>
                <a class="nav-link" href="../admin/userView.php">User</a>
                <a class="nav-link" href="../login/adminLogout.php">Keluar</a>
            </div>
        </div>
    </div>
</div>

<!-- Header -->
<?php include '../includes/header.php' ?>
