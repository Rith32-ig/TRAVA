<?php

include '../config/koneksi.php';

$nama = $_POST['nama'];
$email = $_POST['email'];
$password = md5($_POST['password']);

$cek = mysqli_query($conn,
"SELECT * FROM users
WHERE email='$email'");

if(mysqli_num_rows($cek) > 0){

    echo "
    <script>
        alert('Email sudah digunakan!');
        window.location='../register.php';
    </script>
    ";

}else{

    mysqli_query($conn,
    "INSERT INTO users
    (nama,email,password)
    VALUES
    ('$nama','$email','$password')");

    echo "
    <script>
        alert('Register berhasil!');
        window.location='../login.php';
    </script>
    ";

}


