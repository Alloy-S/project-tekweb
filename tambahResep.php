<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
}
require('connect.php');

if (isset($_POST["submit"])) {


    if (tambah_resep($_POST) > 0) {
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
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <title>Tambah resep baru</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#add-row").click(function() {
                $("#row-langkah").append("<tr><td><input type='text' class='form-control' name='detail_langkah[]'></td></tr>");
            });
        });
    </script>
</head>

<body>
    <h1>tambah data data resep</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label class="form-label" for="nama_resep">Judul Resep : </label>
                <input class="form-control" type="text" name="nama_resep" id="nama_resep" required>
            </li>
            <li>
                <!-- <label for="nama">deskripsi : </label>
                <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"></textarea> -->
                <label for="deskripsi" class="form-label">Example textarea</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
            </li>
            <li>
                <!-- <label for="emai">Langkah-langkah : </label>
                <textarea name="langkah" id="langkah" cols="30" rows="10"></textarea> -->
                <label for="langkah" class="form-label">Langkah-langkah</label>
                <textarea class="form-control" id="langkah" name="langkah" rows="3"></textarea>
            </li>
            <li>
                <label for="jurusan">Gambar : </label>
                <!-- <input type="file" name="gambar" id="gambar"> -->
                <input class="form-control" type="file" id="gamabar" name="gambar">
            </li>
            <!-- <li>
                <label for="gambar">Gambar : </label>
                <input type="file" name="gambar" id ="gambar">
            </li> -->
            <table id="row-langkah">
                <tr>
                    <p>1</p>
                    <td><input type="text" class="form-control" name="detail_langkah[]"></td>
                </tr>
                <tr>
                    <td><input type="text" class="form-control" name="detail_langkah[]"></td>
                </tr>
                <tr>
                    <td><input type="text" class="form-control" name="detail_langkah[]"></td>
                </tr>
            </table>
            <button type="button" id="add-row" class="btn btn-outline-primary">add</button>
            <li>
                <button class="btn btn-primary" type="submit" name="submit">Submit</button>
            </li>
        </ul>

    </form>
    <a href="index.php">Halaman utama</a>

</body>

</html>