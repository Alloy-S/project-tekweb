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
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <script>
        $(document).ready(function() {
            var countLangkah = 4;
            var countBahan = 3;
            $("#add-row-langkah").click(function() {
                $("#row-langkah").append("<tr><td class='pe-3 '>" + countLangkah + "</td><td><input type='text' class='form-control my-1' name='detail_bahan[]'></td><td><a class='px-1 delete-langkah'><i class='fa-sharp fa-solid fa-xmark'></i></a></td></tr>");
                countLangkah++;
            });

            $("#add-row-bahan").click(function() {
                $("#row-bahan").append("<tr><td class='pe-2><i class='fa-sharp fa-solid fa-arrow-right'></i></td><td><input type='text' class='form-control my-1' name='detail_langkah[]'></td><td><a class='px-1 delete-bahan'><i class='fa-sharp fa-solid fa-xmark'></i></a></td></tr>");
                countBahan++;
            });

            $(document).on("click", ".delete-langkah", function(e) {
                $(this).parent().parent().remove()
                countLangkah--;
            });

            $(document).on("click", ".delete-bahan", function(e) {
                $(this).parent().parent().remove()

            });
        });
    </script>
    <!-- <style>
        table, th, td {
            border: solid black 1px;
        }
    </style> -->
</head>

<body>
    <div class="container orange-200">
        <h1>tambah data data resep</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <ul>
                <li>
                    <label class="form-label" for="nama_resep">Judul Resep : </label>
                    <input class="form-control" type="text" name="nama_resep" id="nama_resep" maxlength="30" required>
                </li>
                <li>
                    <!-- <label for="nama">deskripsi : </label>
                <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"></textarea> -->
                    <label for="deskripsi" class="form-label">Example textarea</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                </li>
                <li>
                    <label for="row-bahan">bahan-bahan</label>
                    <table id="row-bahan">

                        <tr>
                            <td class="pe-3 "><i class="fa-sharp fa-solid fa-arrow-right"></i></td>
                            <td class="d-flex justify-content-between">
                                <input type="text" class="form-control my-1" name="detail_bahan[]">
                            </td>
                            <!-- <td>
                                <a class="px-1 delete-bahan"><i class="fa-sharp fa-solid fa-xmark"></i></a>
                            </td> -->
                        </tr>

                        <tr>
                            <td class="pe-2"><i class="fa-sharp fa-solid fa-arrow-right"></i></td>
                            <td><input type="text" class="form-control my-1" name="detail_bahan[]"></td>
                        </tr>

                    </table>
                    <button type="button" id="add-row-bahan" class="btn btn-outline-primary">add</button>
                </li>
                <li>
                    <label for="row-langkah">Langkah-Langkah</label>
                    <table id="row-langkah">
                        <tr>
                            <td class="pe-3 ">1</td>
                            <td><input type="text" class="form-control my-1" name="detail_langkah[]"></td>
                            <!-- <td>
                                <a class="px-1 delete"><i class="fa-sharp fa-solid fa-xmark"></i></a>
                            </td> -->
                        </tr>
                        <tr>
                            <td class="pe-2">2</td>
                            <td><input type="text" class="form-control my-1" name="detail_langkah[]"></td>
                        </tr>
                        <tr>
                            <td class="pe-2">3</td>
                            <td><input type="text" class="form-control my-1" name="detail_langkah[]"></td>
                        </tr>
                    </table>
                    <button type="button" id="add-row-langkah" class="btn btn-outline-primary">add</button>
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

                <li>
                    <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                </li>
            </ul>

        </form>
        <a href="index.php">Halaman utama</a>
    </div>

</body>

</html>