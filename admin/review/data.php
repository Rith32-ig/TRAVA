<?php
include '../../admin/auth/cek_login.php';
include '../../config/koneksi.php';
include '../../admin/partials/header.php';
include '../../admin/partials/navbar.php';

$query = mysqli_query($conn, "
    SELECT review.*, users.nama as nama_user, wisata.nama as nama_wisata
    FROM review
    JOIN users ON review.user_id = users.id
    JOIN wisata ON review.wisata_id = wisata.id
    ORDER BY review.created_at DESC
");
?>

<div class="admin-topbar">
    <h5 class="mb-0 fw-bold">Data Review</h5>
</div>

<div class="main-content">

    <?php if(isset($_GET['msg'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_GET['msg']); ?></div>
    <?php endif; ?>

    <div class="card border-0 shadow" style="border-radius:20px; overflow:hidden;">
        <table class="table table-hover mb-0">
            <thead style="background:linear-gradient(to right,#f9c74f,#f9844a); color:white;">
                <tr>
                    <th class="p-3">No</th>
                    <th>User</th>
                    <th>Wisata</th>
                    <th>Rating</th>
                    <th>Komentar</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 1; while($row = mysqli_fetch_assoc($query)): ?>
                <tr>
                    <td class="p-3"><?= $no++; ?></td>
                    <td class="fw-semibold"><?= $row['nama_user']; ?></td>
                    <td><?= $row['nama_wisata']; ?></td>
                    <td>
                        <span class="text-warning fw-bold">⭐ <?= $row['rating']; ?>/5</span>
                    </td>
                    <td style="max-width:200px;"><?= substr($row['komentar'],0,80); ?>...</td>
                    <td class="text-muted small"><?= date('d/m/Y', strtotime($row['created_at'])); ?></td>
                    <td>
                        <a href="hapus.php?id=<?= $row['id']; ?>&wisata_id=<?= $row['wisata_id']; ?>"
                        class="btn btn-sm btn-danger"
                        onclick="return confirm('Hapus review ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</div>

<?php include '../admin/partials/footer.php'; ?>