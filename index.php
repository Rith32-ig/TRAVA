<?php
include 'config/koneksi.php';
include 'admin/partials/header.php';
include 'admin/partials/navbar.php';

// ambil data wisata
$query = mysqli_query($conn, "SELECT * FROM wisata ORDER BY created_at DESC");
?>

<div class="container mt-4">

    <!-- HERO -->
    <div class="hero mb-4">
        <h2>Jelajahi Wisata Cirebon 🌴</h2>
        <p>Temukan destinasi terbaik untuk liburan kamu</p>
    </div>

    <!-- LIST WISATA -->
    <div class="row">

        <?php while($row = mysqli_fetch_assoc($query)) : ?>

        <div class="col-md-4 mb-4">
            <div class="card shadow">

                <!-- GAMBAR -->
                <img src="assets/img/<?= $row['gambar']; ?>" class="card-img-top">

                <div class="card-body">

                    <!-- NAMA -->
                    <h5><?= $row['nama']; ?></h5>

                    <!-- LOKASI -->
                    <p class="text-muted mb-1">
                        📍 <?= $row['lokasi']; ?>
                    </p>

                    <!-- RATING -->
                    <div class="rating mb-2">
                        ⭐ <?= number_format($row['rating_avg'],1); ?> 
                        (<?= $row['rating_count']; ?>)
                    </div>

                    <!-- HARGA -->
                    <p class="text-success fw-bold">
                        Rp <?= number_format($row['harga']); ?>
                    </p>

                    <!-- BUTTON -->
                    <a href="detail.php?id=<?= $row['id']; ?>" class="btn btn-primary w-100">
                        Lihat Detail
                    </a>

                </div>
            </div>
        </div>

        <?php endwhile; ?>

    </div>
</div>

<?php include 'admin/partials/footer.php'; ?>