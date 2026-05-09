<?php
include 'config/koneksi.php';
include 'admin/partials/header.php';
include 'admin/partials/navbar.php';

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM wisata WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

$review = mysqli_query($conn, "
    SELECT review.*, users.nama 
    FROM review
    JOIN users ON review.user_id = users.id
    WHERE wisata_id='$id'
    ORDER BY created_at DESC
");
?>

<div class="container mt-4 mb-5">

    <!-- GAMBAR -->
    <div class="card overflow-hidden border-0 shadow mb-4">
        <img 
            src="assets/img/<?= $data['gambar']; ?>" 
            class="w-100"
            style="height:450px; object-fit:cover;"
        >
    </div>

    <div class="row">

        <!-- KIRI -->
        <div class="col-md-8">

            <h2 class="fw-bold mb-3">
                <?= $data['nama']; ?>
            </h2>

            <p class="text-muted mb-3">
                📍 <?= $data['alamat_detail']; ?>
            </p>

            <div class="mb-4 text-warning fw-semibold">
                ⭐ <?= number_format($data['rating_avg'],1); ?>
                (<?= $data['rating_count']; ?> review)
            </div>

            <!-- DESKRIPSI -->
            <div class="card border-0 shadow-sm p-4 mb-4">

                <h5 class="mb-3">
                    Deskripsi
                </h5>

                <p class="mb-0">
                    <?= $data['deskripsi']; ?>
                </p>

            </div>

            <!-- FASILITAS -->
            <div class="card border-0 shadow-sm p-4 mb-4">

                <h5 class="mb-3">
                    Fasilitas
                </h5>

                <p class="mb-0">
                    <?= $data['fasilitas']; ?>
                </p>

            </div>

            <!-- AKTIVITAS -->
            <div class="card border-0 shadow-sm p-4 mb-4">

                <h5 class="mb-3">
                    Aktivitas
                </h5>

                <p class="mb-0">
                    <?= $data['aktivitas']; ?>
                </p>

            </div>

        </div>

        <!-- KANAN -->
        <div class="col-md-4">

            <div class="card border-0 shadow p-4 sticky-top"
            style="top:100px; border-radius:20px;">

                <h3 class="text-success fw-bold mb-3">
                    Rp <?= number_format($data['harga']); ?>
                </h3>

                <a href="#" class="btn btn-danger w-100 mb-2">
                    ❤️ Tambah Wishlist
                </a>

                <a href="#" class="btn btn-primary w-100">
                    ✈️ Buat Trip
                </a>

            </div>

        </div>

    </div>

    <!-- GOOGLE MAPS -->
    <div class="mt-5">

        <div class="card border-0 shadow-sm p-4">

            <h4 class="mb-4">
                Lokasi Wisata
            </h4>

            <?= $data['maps']; ?>

        </div>

    </div>

    <!-- REVIEW -->
    <div class="mt-5">

        <h4 class="mb-4">
            Review Pengunjung
        </h4>

        <?php while($r = mysqli_fetch_assoc($review)) : ?>

            <div class="card border-0 shadow-sm mb-3">

                <div class="card-body">

                    <h6 class="fw-bold">
                        <?= $r['nama']; ?>
                    </h6>

                    <div class="text-warning mb-2">
                        ⭐ <?= $r['rating']; ?>/5
                    </div>

                    <p class="mb-0">
                        <?= $r['komentar']; ?>
                    </p>

                </div>

            </div>

        <?php endwhile; ?>

    </div>

</div>

<?php include 'admin/partials/footer.php'; ?>