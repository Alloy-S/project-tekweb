<?php 
session_start();

if (!isset($_SESSION["login_user"])) {
    header("Location: login2.php");
}
require('connect.php');
$id = $_GET['id'];

$resep = mysqli_query($conn, "SELECT * FROM resep WHERE id_resep = '$id'");
$resep = mysqli_fetch_assoc($resep);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resep</title>
    <link rel="stylesheet" href="MDB5/css/mdb.min.css" />
    <script type="text/javascript" src="MDB5/js/mdb.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="fa_icons/css/all.css"> -->
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <style>
        body {
            background-color: #D0d2d2;
        }

        .field-input {
            background-color: white;
            padding: 10px;
            margin-bottom: 15px;
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

            </div>
            <!-- Collapsible wrapper -->

            <!-- Right elements -->
            <?php if (isset($_SESSION["login_user"])) : ?>
                <div class="d-flex align-items-center mt-md-4">

                    <!-- Avatar -->
                    <div class="dropdown ">

                        <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user fa-xl"></i>
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
            <h1 class="text-center m-3">Edit Resep</h1>

            <form action="function/tambahResepDb.php" method="post" id="form-addResep" enctype="multipart/form-data">
                <div class="field-input">

                    <label class="form-label" for="nama_resep">Judul Resep : </label>
                    <input class="form-control" type="text" name="nama_resep" id="nama_resep" maxlength="30" value="<?= $resep['nama_resep']; ?>" required>


                    <!-- <label for="nama">deskripsi : </label>
                <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"></textarea> -->
                    <label for="deskripsi" class="form-label">Deskripsi resep</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" ><?= $resep['deskripsi']; ?></textarea>

                    <select class="form-select mt-3" aria-label="Default select example" name="kategori" required>
                        <option selected>Pilih Kategori</option>
                        <?php foreach ($data as $row) : ?>

                            <option value="<?= $row['id_kategori']; ?>"><?= $row['nama']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="field-input">
                    <label for="row-bahan">Bahan-bahan</label>
                    <ol id="row-bahan">
                        <li>
                            <div class="row ">
                                <div class="col-5"><input type="text" class="form-control" name="detail_takaran[]" placeholder="takaran"></div>
                                <div class="col-5"><input type="text" class="form-control" name="detail_bahan[]" placeholder="bahan"></div>
                                <div class="col-2"><a class="delete-bahan"><i class="fa-solid fa-xmark fa-xl"></i></a></div>
                            </div>
                        </li>
                        <li>
                            <div class="row my-2">
                                <div class="col-5">
                                    <input type="text" class="form-control" name="detail_takaran[]" placeholder="takaran">
                                </div>
                                <div class="col-5">
                                    <input type="text" class="form-control" name="detail_bahan[]" placeholder="bahan">
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
                    <input class="form-control image" type="file">
                    <input type="hidden" name="image-name" id="image-name">

                    <select class="form-select mt-3" aria-label="Default select example" name="is_private" id="is_private" required>
                        <option value="false">Public</option>
                        <option value="true">Private</option>
                    </select>
                </div>

                <div class="field-input">
                    <button class="btn btn-primary" type="submit" id="submit" name="submit">Submit</button>
                </div>

            </form>
        </div>
    </div>
    
</body>
</html>