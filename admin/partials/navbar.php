<?php if(session_status() == PHP_SESSION_NONE) session_start(); ?>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">

        <a class="navbar-brand" href="index.php">
            <img src="assets/img/logo-trava.png" class="logo-navbar">
        </a>

        <div class="ms-auto">

            <?php if(isset($_SESSION['user_id'])): ?>
                <span class="text-white me-3">
                    Halo, <?= $_SESSION['nama']; ?>
                </span>

                <a href="wishlist.php" class="btn btn-light btn-sm me-2">Wishlist</a>
                <a href="profil.php" class="btn btn-light btn-sm me-2">Profil</a>
                <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-light btn-sm">Login</a>
            <?php endif; ?>

        </div>

    </div>
</nav>