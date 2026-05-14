<?php
session_start();

include '../config/koneksi.php';


// ======================
// CEK LOGIN
// ======================

if(!isset($_SESSION['login'])){

    header("Location: ../login.php");
    exit;
}


// ======================
// AMBIL DATA
// ======================

$user_id = $_SESSION['user_id'];

$wisata_id = $_POST['wisata_id'];
$rating = $_POST['rating'];
$komentar = htmlspecialchars($_POST['komentar']);


// ======================
// INSERT REVIEW
// ======================

mysqli_query($conn, "
INSERT INTO review
(user_id, wisata_id, komentar, rating)
VALUES
('$user_id', '$wisata_id', '$komentar', '$rating')
");


// ======================
// UPDATE TOTAL REVIEW USER
// ======================

mysqli_query($conn, "
UPDATE users
SET total_review = total_review + 1
WHERE id='$user_id'
");


// ======================
// HITUNG RATING RATA-RATA
// ======================

$avg = mysqli_query($conn, "
SELECT
AVG(rating) as rata,
COUNT(id) as total
FROM review
WHERE wisata_id='$wisata_id'
");

$data = mysqli_fetch_assoc($avg);

$rating_avg = $data['rata'];
$rating_count = $data['total'];


// ======================
// UPDATE DATA WISATA
// ======================

mysqli_query($conn, "
UPDATE wisata
SET
rating_avg='$rating_avg',
rating_count='$rating_count'
WHERE id='$wisata_id'
");


// ======================
// REDIRECT KEMBALI
// ======================

header("Location: ../detail.php?id=$wisata_id");
exit;