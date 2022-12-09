<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
}
require('connect.php');

if (isset($_POST["submit"])) {


    if (tambah($_POST) > 0) {
        echo "
    <script>
        alert('data berhasil ditambahkan!');
        document.location.href = 'index.php';
    </script>
    ";
    } else {
        echo "
    <script>
        alert('data gagal ditambahkan!');
        document.location.href = 'index.php';
    </script>
    ";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah data Mahasiswa</title>
</head>

<body>
    <h1>tambah data mahasiswa</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nrp">Nrp : </label>
                <input type="text" name="nrp" id="nrp" required>
            </li>
            <li>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama" required>
            </li>
            <li>
                <label for="email">Domisili : </label>
                <input type="text" name="domisili" id="domisili">
            </li>
            <li>
                <label for="jurusan">Alamat : </label>
                <input type="text" name="alamat" id="alamat">
            </li>
            <!-- <li>
                <label for="gambar">Gambar : </label>
                <input type="file" name="gambar" id ="gambar">
            </li> -->
            <li>
                <button type="submit" name="submit">Submit</button>
            </li>
        </ul>
    </form>
    <a href="index.php">Halaman utama</a>
</body>

</html>