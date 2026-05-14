<?php
session_start();

include 'config/koneksi.php';
include 'admin/partials/header.php';
include 'admin/partials/navbar.php';

$id = $_GET['id'];

$query = mysqli_query($conn,
"SELECT * FROM wisata WHERE id='$id'");

$data = mysqli_fetch_assoc($query);

$review = mysqli_query($conn, "
SELECT review.*, users.nama
FROM review
JOIN users ON review.user_id = users.id
WHERE wisata_id='$id'
ORDER BY created_at DESC
");
?>

<style>

.rating{
    display:flex;
    flex-direction: row-reverse;
    justify-content:flex-end;
    gap:5px;
}

.rating input{
    display:none;
}

.rating label{
    font-size:40px;
    color:#ccc;
    cursor:pointer;
    transition:0.2s;
}

.rating input:checked ~ label{
    color:gold;
}

.rating label:hover,
.rating label:hover ~ label{
    color:gold;
}

</style>

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

        <!-- FORM REVIEW -->
        <?php if(isset($_SESSION['login'])) : ?>

        <div class="card border-0 shadow-sm p-4 mb-4">

            <h5 class="mb-3">
                Tulis Review
            </h5>

            <form action="proses/review_proses.php" method="POST">

                <input
                    type="hidden"
                    name="wisata_id"
                    value="<?= $id; ?>"
                >

                <!-- RATING BINTANG -->
                <div class="mb-3">

                    <label class="form-label mb-2">
                        Rating
                    </label>

                    <div class="rating">

                        <input type="radio" name="rating" value="5" id="star5" required>
                        <label for="star5">★</label>

                        <input type="radio" name="rating" value="4" id="star4">
                        <label for="star4">★</label>

                        <input type="radio" name="rating" value="3" id="star3">
                        <label for="star3">★</label>

                        <input type="radio" name="rating" value="2" id="star2">
                        <label for="star2">★</label>

                        <input type="radio" name="rating" value="1" id="star1">
                        <label for="star1">★</label>

                    </div>

                </div>

                <!-- KOMENTAR -->
                <div class="mb-3">

                    <label class="form-label">
                        Komentar
                    </label>

                    <textarea
                        name="komentar"
                        class="form-control"
                        rows="4"
                        required
                    ></textarea>

                </div>

                <button class="btn btn-primary">
                    Kirim Review
                </button>

            </form>

        </div>

        <?php else : ?>

        <div class="alert alert-warning">
            Login terlebih dahulu untuk memberi review
        </div>

        <?php endif; ?>


        <!-- LIST REVIEW -->
        <?php if(mysqli_num_rows($review) > 0) : ?>

            <?php while($r = mysqli_fetch_assoc($review)) : ?>

            <div class="card border-0 shadow-sm mb-3">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-2">

                        <h6 class="fw-bold mb-0">
                            <?= $r['nama']; ?>
                        </h6>

                        <small class="text-muted">
                            <?= date('d M Y', strtotime($r['created_at'])); ?>
                        </small>

                    </div>

                    <!-- BINTANG REVIEW -->
                    <div class="text-warning mb-2" style="font-size:20px;">

                    <?php
                    for($i=1; $i<=5; $i++){

                        if($i <= $r['rating']){
                            echo "⭐";
                        }else{
                            echo "☆";
                        }

                    }
                    ?>

                    </div>

                    <p class="mb-0">
                        <?= $r['komentar']; ?>
                    </p>

                </div>

            </div>

            <?php endwhile; ?>

        <?php else : ?>

            <div class="alert alert-secondary">
                Belum ada review
            </div>

        <?php endif; ?>

    </div>

</div>

<?php include 'admin/partials/footer.php'; ?>