<?php
require('../connect.php');
session_start();
if (!isset($_SESSION["login_admin"])) {
    header("Location: login_admin.php");
}

$data = query("SELECT * FROM resep");
$kategori = query("SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Workspace</title>
    <link rel="stylesheet" href="../MDB5/css/mdb.min.css" />
    <script type="text/javascript" src="../MDB5/js/mdb.min.js"></script>
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <style>
        body {
            margin: auto;
            font-family: -apple-system, BlinkMacSystemFont, sans-serif;
            overflow: auto;
            background: linear-gradient(315deg, rgba(231, 152, 255, 1) 3%, rgba(60, 132, 206, 1) 38%, rgba(48, 238, 226, 1) 68%, rgba(255, 170, 25, 1) 98%);
            animation: gradient 15s ease infinite;
            background-size: 400% 400%;
            background-attachment: fixed;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 0%;
            }

            50% {
                background-position: 100% 100%;
            }

            100% {
                background-position: 0% 0%;
            }
        }

        .wave {
            background: rgb(255 255 255 / 20%);
            border-radius: 1000% 1000% 0 0;
            position: fixed;
            width: 200%;
            height: 12em;
            animation: wave 10s -3s linear infinite;
            transform: translate3d(0, 0, 0);
            opacity: 0.8;
            bottom: 0;
            left: 0;
            z-index: -1;
        }

        .wave:nth-of-type(2) {
            bottom: -1.25em;
            animation: wave 18s linear reverse infinite;
            opacity: 0.8;
        }

        .wave:nth-of-type(3) {
            bottom: -2.5em;
            animation: wave 20s -1s reverse infinite;
            opacity: 0.9;
        }

        @keyframes wave {
            2% {
                transform: translateX(1);
            }

            25% {
                transform: translateX(-25%);
            }

            50% {
                transform: translateX(-50%);
            }

            75% {
                transform: translateX(-25%);
            }

            100% {
                transform: translateX(1);
            }
        }
    </style>
</head>

<body>
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
    <!-- Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar brand -->
                <a class="navbar-brand mt-2 mt-lg-0 ms-1" href="index.php">
                    <img src="white.png" height="45" alt="Gudang Resep Logo" loading="lazy" />
                    <!-- <small>Admin Workspace</small>
                    <img src="Gudang Resep.png" height="45" alt="Gudang Resep Logo" loading="lazy"/> -->
                </a>

                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-0 ms-3 mb-lg-0">
                <li class="nav-item ms-3">
                        <a class="nav-link" href="../index.php">Live Website</a>
                    </li>
                    <li class="nav-item ms-4">
                        <a class="nav-link active font-weight-bold" href="#">Approval Page</a>
                    </li>
                    <li class="nav-item ms-4">
                        <a class="nav-link" href="tambahKategori.php">Add New Category</a>
                    </li>
                </ul>
                <!-- Left links -->


                <!-- Right links -->
                <li class="nav-item dropdown mb-2 me-3">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <img src="../img/anonymous.jpg" class="rounded-circle" height="40" alt="Profile" loading="lazy" />
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <li>
                            <a class="dropdown-item" href="#">My profile</a>
                        </li>
                        <?php if ($_SESSION['login_admin'] === "1") : ?>
                            <li>
                                <a class="dropdown-item" href="tambahAdmin.php">Add new Admin</a>
                            </li>
                        <?php endif; ?>
                        <li>
                            <a class="dropdown-item" href="logout_admin.php">Logout</a>
                        </li>
                    </ul>
                </li>
                <!-- Right links -->
            </div>
        </div>
    </nav>
    <!-- Navbar -->

    <!-- Content -->
    <div class="container-fluid bg-secondary text-white">
        <!-- Search Bar -->
        <div class="d-flex justify-content-between py-3 ps-3 text-dark">
            <h3 class="mt-3">Hello <?= $_SESSION['name_admin']; ?>, welcome to Admin Dashboard</h3>

            <div class="input-group w-25 d-flex justify-content-between mt-2">
                <div class="form-outline">
                    <input id="search-focus" type="search" id="form1" class="form-control" />
                    <label class="form-label" for="form1">Search</label>
                </div>
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>

        <!-- Table -->
        <table class="table align-middle mb-0 bg-secondary text-white">
            <thead class="bg-secondary text-white h5 fw-bold">
                <tr>
                    <th><strong>Menu Name</strong></th>
                    <th><strong>Category</strong></th>
                    <th><strong>Author</strong></th>
                    <th><strong>Status</strong></th>
                    <th><strong>Actions</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row) : ?>

                    <tr>
                        <td style="padding-right: 50px" ;>
                            <div class="d-flex align-items-center">
                                <img src="../img/resep_img/<?= $row['gambar']; ?>" alt="" style="width: 135px; height: 95px" class="rounded" />
                                <div class="ms-3">
                                    <p class="fw-bold mb-1 h3"><?= $row['nama_resep']; ?></p>
                                    <!-- <p class="text-muted mb-0">john.doe@gmail.com</p> -->
                                </div>
                            </div>
                        </td>
                        <td>
                            <?php foreach ($kategori as $kat) : ?>
                                <?php if ($row['id_kategori'] === $kat['id_kategori']) : ?>
                                    <h5 class="fw-normal mb-1 text-dark"><?= $kat['nama']; ?></h5>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td>
                            <div class="h6"> <em> <?= $row['author']; ?></em></div>
                        </td>
                        <td>
                            <?php if ($row['is_approved'] === "1" and $row['is_private'] === "0") : ?>
                                <span class="badge badge-success rounded-pill d-inline">Live</span>
                            <?php elseif ($row['is_approved'] === "0" and $row['is_private'] === "0") : ?>
                                <span class="badge badge-warning rounded-pill d-inline">Pending</span>
                            <?php elseif ($row['is_approved'] === "0" and $row['is_private'] === "1") : ?>
                                <span class="badge badge-primary rounded-pill d-inline">Private</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="detailResep_admin.php?id=<?= $row["id_resep"]; ?>"> <button type="button" class="btn btn-primary btn-rounded btn-sm" data-mdb-ripple-color="#f4ecb8"> ACTION </button></a>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</body>

</html>