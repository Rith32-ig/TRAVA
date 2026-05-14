<?php

include 'auth/cek_login.php';
include '../config/koneksi.php';

$user =
mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM users")
);

$wisata =
mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM wisata")
);

$review =
mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM review")
);

$trip =
mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM trip")
);

include 'partials/header.php';
include 'partials/sidebar.php';

?>

<div class="main-content">

<h2 class="fw-bold mb-4">
Dashboard
</h2>

<div class="row">

<div class="col-lg-3 mb-4">

<div class="card-dashboard">

<h5>Total User</h5>

<h1 class="fw-bold">
<?= $user; ?>
</h1>

</div>

</div>

<div class="col-lg-3 mb-4">

<div class="card-dashboard">

<h5>Total Wisata</h5>

<h1 class="fw-bold">
<?= $wisata; ?>
</h1>

</div>

</div>

<div class="col-lg-3 mb-4">

<div class="card-dashboard">

<h5>Total Review</h5>

<h1 class="fw-bold">
<?= $review; ?>
</h1>

</div>

</div>

<div class="col-lg-3 mb-4">

<div class="card-dashboard">

<h5>Total Trip</h5>

<h1 class="fw-bold">
<?= $trip; ?>
</h1>

</div>

</div>

</div>

</div>

<?php include 'partials/footer.php'; ?>