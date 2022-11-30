<?php
session_start();
require("connect.php");
// if (!isset($_SESSION["login"])) {
//     header("Location: login.php");
// }

$data = query("SELECT * FROM resep");
// var_dump($data);
// print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home</title>
    <link rel="stylesheet" href="MDB5/css/mdb.min.css" />
    <script type="text/javascript" src="MDB5/js/mdb.min.js"></script>
    <!-- <link rel="stylesheet" href="fa_icons/css/all.css"> -->
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body style='background-color:#c6c9ca'>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top" style='background-color:transparent'>
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar brand -->
                <a class="navbar-brand mt-2 mt-lg-0" href="#" style='background-color:transparent'>
                    <img src="img\white.png" height="45" alt="GR Logo" loading="lazy"/>
                </a>
                <!-- <div class="container-xl ms-5 position-absolute top-50 start-100 translate-middle"> -->
                    <div class="input-group d-flex justify-content-center">
                        <div class="form-outline w-25">
                            <input type="search" id="form1" class="form-control text-light"/>
                            <label class="form-label text-light" for="form1">Search</label>
                        </div>
                        <button type="button" class="btn" style="background-color:transparent">
                            <i class="fas fa-search text-light"></i>
                        </button>
                    </div>
                <!-- </div> -->
            </div>
            <!-- Collapsible wrapper -->

            <!-- Right elements -->
            <?php if (isset($_SESSION["login"])) : ?>
                <div class="d-flex align-items-center">

                    <!-- Notifications -->
                    <div class="dropdown">
                        <a class="text-reset me-3 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell" style="color: white;"></i>
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
                    </div>
                    <!-- Avatar -->
                    <div class="dropdown">
                        <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user" style="color: white;"></i>
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
                        <button type="button" class="btn btn-light btn-rounded" data-mdb-ripple-color="dark">Login</button>
                    </a>
                </div>
            <?php endif; ?>
            <!-- Right elements -->
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
    <div id="background">
        <div class="jumbotron">
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Optio libero corrupti, consequuntur, blanditiis, sint quod maxime molestiae voluptatibus ratione neque</p>
            <hr class="my-8">
            <h1 class="display-5">GUDANG RESEP</h1>
            <button type="button" class="btn btn-primary" id='bounce' onClick="document.getElementById('card-resep').scrollIntoView();">
                <i class="fa-regular fa-solid fa-arrow-down fa-xl"></i>
            </button>
        </div>
    </div>

    <div class="container" id='card-resep'>
        <div class="d-flex">
            <?php if (isset($_SESSION["login"])) : ?>

                <a href="logout.php">
                    <button type="button" class="btn btn-primary">Logout</button>
                </a>
                <a href="tambah.php">
                    <button type="button" class="btn btn-primary">tambah</button>
                </a>
                <a href="tambahResep.php">
                    <button type="button" class="btn btn-primary">tambah resep</button>
                </a>
            <?php endif; ?>
        </div>
        <div class="row row-cols-4">
            <?php foreach ($data as $row) : ?>
                <div class="col" style="padding-top: 10px;">
                    <a href="detailResep.php?id=<?= $row["id_resep"]; ?>">
                        <div class="card m-2" style="width: 18rem;">
                            <div class="ratio ratio-16x9">
                                <img src="img/<?= $row["gambar"]; ?>" class="card-img-top" alt="<?= $row["nama_resep"]; ?>" style="object-fit:cover">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?= $row["nama_resep"]; ?></h5>
                                <!-- <p class="card-text"><?= $row["deskripsi"]; ?></p> -->
                                <!-- <a href="detailResep.php?id=<?= $row["id_resep"]; ?>" class="btn btn-primary sticky-bottom">More</a> -->
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    
</body>
</html>