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

    <link rel="stylesheet" href="MDB5/css/mdb.min.css" />
    <script type="text/javascript" src="MDB5/js/mdb.min.js"></script>
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">

    <title>Tambah resep baru</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <script>
        $(document).ready(function() {
            $("#add-row-langkah").click(function() {
                $("#row-langkah").append("<li><div class='row my-2'><div class='col-6'><input type='text' class='form-control' name='detail_langkah[]'></div><div class='col-2'><a class='delete-langkah'><i class='fa-sharp fa-solid fa-xmark fa-xl'></i></a></div></div></li>");
            });

            $("#add-row-bahan").click(function() {
                $("#row-bahan").append("<li><div class='row my-2'><div class='col-6'><input type='text' class='form-control' name='detail_bahan[]'></div><div class='col-2'><a class='delete-bahan'><i class='fa-sharp fa-solid fa-xmark fa-xl'></i></a></div></div></li>");

            });

            $(document).on("click", ".delete-langkah", function(e) {
                $(this).parent().parent().parent().remove()
            });

            $(document).on("click", ".delete-bahan", function(e) {
                $(this).parent().parent().parent().remove()
            });
        });
    </script>
    <style>
        body {
            background-color: #E9ffda;
        }



        .field-input {
            background-color: white;
            padding: 10px;
            margin-bottom: 15px;
        }

        .content {
            width: 50%;
        }

        @media screen and (max-width: 992px) {
            .content {
                width: 100%;
            }
        }

        
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar brand -->
                <a class="navbar-brand mt-2 mt-lg-0" href="index.php">
                    <img src="img\Gudang Resep.png" height="45" alt="GR Logo" loading="lazy" />
                </a>
                <!-- <div class="container-xl ms-5 position-absolute top-50 start-100 translate-middle"> -->
                <!-- <div class="input-group d-flex justify-content-center">
                    <div class="form-outline w-25">
                        <input type="search" id="form1" class="form-control" />
                        <label class="form-label" for="form1">Search</label>
                    </div>
                    <button type="button" class="btn btn-outline-secondary">
                        <i class="fas fa-search"></i>
                    </button>
                </div> -->
                <!-- </div> -->
            </div>
            <!-- Collapsible wrapper -->

            <!-- Right elements -->
            <?php if (isset($_SESSION["login"])) : ?>
                <div class="d-flex align-items-center mt-md-4">

                    <!-- Notifications -->
                    <!-- <div class="dropdown">
                        <a class="text-reset me-3 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            <span class="badge rounded-pill badge-notification bg-danger">1</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <a class="dropdown-item" href="#">Some news</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Another news</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </li>
                        </ul>
                    </div> -->
                    <!-- Avatar -->
                    <div class="dropdown ">
                        <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user"></i>
                            <!-- <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="rounded-circle" height="25" alt="Black and White Portrait of a Man" loading="lazy" /> -->
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                            <li>
                                <a class="dropdown-item" href="#">My profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Settings</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php else : ?>
                <div class="d-flex align-items-center">
                    <a class="text-reset me-3" href="login2.php">
                        <button type="button" class="btn btn-outline-primary btn-rounded" data-mdb-ripple-color="dark">Login</button>
                    </a>
                </div>
            <?php endif; ?>
            <!-- Right elements -->
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
    <div class="container-fluid d-flex align-items-center justify-content-center">
        <div class="content">
        <h1 class="text-center m-3">Tulis Resep Baru</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="field-input">

                <label class="form-label" for="nama_resep">Judul Resep : </label>
                <input class="form-control" type="text" name="nama_resep" id="nama_resep" maxlength="30" required>


                <!-- <label for="nama">deskripsi : </label>
                <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"></textarea> -->
                <label for="deskripsi" class="form-label">Deskripsi resep</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>

            </div>
            <div class="field-input">
                <label for="row-bahan">bahan-bahan</label>
                <ol id="row-bahan">
                    <li>
                        <div class="row my-2">
                            <div class="col-6"><input type="text" class="form-control" name="detail_bahan[]"></div>
                            <div class="col-2"><a class="delete-bahan"><i class="fa-sharp fa-solid fa-xmark fa-xl"></i></a></div>
                        </div>
                    </li>
                    <li>
                        <div class="row my-2">
                            <div class="col-6">
                                <input type="text" class="form-control" name="detail_bahan[]">
                            </div>
                            <div class="col-2">
                                <a class="delete-bahan"><i class="fa-sharp fa-solid fa-xmark fa-xl"></i></a>
                            </div>
                        </div>
                    </li>
                </ol>
                <button type="button" id="add-row-bahan" class="btn btn-outline-primary">add</button>
            </div>
            <div class="field-input">
                <label for="row-langkah">Langkah-Langkah</label>
                <ol id="row-langkah">
                    <li>
                        <div class="row my-2">
                            <div class="col-6">
                                <input type="text" class="form-control" name="detail_langkah[]">
                            </div>
                            <div class="col-2">
                                <a class="delete-langkah"><i class="fa-sharp fa-solid fa-xmark fa-xl"></i></a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row my-2">
                            <div class="col-6">
                                <input type="text" class="form-control" name="detail_langkah[]">
                            </div>
                            <div class="col-2">
                                <a class="delete-langkah"><i class="fa-sharp fa-solid fa-xmark fa-xl"></i></a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row my-2">
                            <div class="col-6">
                                <input type="text" class="form-control" name="detail_langkah[]">
                            </div>
                            <div class="col-2">
                                <a class="delete-langkah"><i class="fa-sharp fa-solid fa-xmark fa-xl"></i></a>
                            </div>
                        </div>
                    </li>
                </ol>
                <button type="button" id="add-row-langkah" class="btn btn-outline-primary">add</button>
            </div>
            <div class="field-input">
                <label for="jurusan">Gambar : </label>
                <!-- <input type="file" name="gambar" id="gambar"> -->
                <input class="form-control" type="file" id="gamabar" name="gambar">
            </div>
            <!-- <li>
                <label for="gambar">Gambar : </label>
                <input type="file" name="gambar" id ="gambar">
            </li> -->

            <div class="field-input">
                <button class="btn btn-primary" type="submit" name="submit">Submit</button>
            </div>

        </form>
        <a href="index.php">Halaman utama</a>
        </div>
    </div>

</body>

</html>