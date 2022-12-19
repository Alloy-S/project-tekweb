<?php
session_start();
if (!isset($_SESSION["login_admin"])) {
    header("Location: login_admin.php");
}
require("../connect.php");
$result = mysqli_query($conn, "SELECT * FROM kategori");

mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
    <link rel="stylesheet" href="../MDB5/css/mdb.min.css" />
    <script type="text/javascript" src="../MDB5/js/mdb.min.js"></script>
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $("#submit-kategori").click(function(e) {
                e.preventDefault();
                var data = $("#data-kategori");
                $.ajax({
                    type: "POST",
                    url: "../ajax/tambahKategori.php",
                    data: data.serialize(),
                    success: function(response) {
                        $('tbody').html(response);
                        Swal.fire(
                            'Berhasil ditambahkan!',
                            '',
                            'success'
                        );
                        $("#data-kategori")[0].reset();
                    }
                });
            });

            $('body').on("click", ".delete", function() {
                $.ajax({
                    type: "POST",
                    url: "../ajax/deleteKategori.php",
                    data: {
                        id: $(this).val()
                    },
                    success: function(response) {
                        $('tbody').html(response);
                        Swal.fire(
                            'Berhasil dihapus!',
                            '',
                            'success'
                        )

                    }
                });
            });
        });
    </script>
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

        tr,
        td {
            background-color: white;
        }

        .card {
            width: 25%;
        }

        @media screen and (max-width: 992px) {
            .card {
                width: 87%;
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
                </a>

                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-0 ms-3 mb-lg-0">
                    <li class="nav-item ms-3">
                        <a class="nav-link" href="../index.php">Live Website</a>
                    </li>
                    <li class="nav-item ms-4">
                        <a class="nav-link" href="approvalPage.php">approval Page</a>
                    </li>
                    <li class="nav-item ms-4">
                        <a class="nav-link active" href="tambahKategori.php">Tambah Kategori</a>
                    </li>
                </ul>
                <!-- Left links -->


                <!-- Right links -->
                <li class="nav-item dropdown mb-2 me-3">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <img src="../img/anonymous.jpg" class="rounded-circle" height="35" alt="Profile" loading="lazy" />
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

    <div class="container-fluid d-lg-flex flex-row">
        <div class="card  m-3">
            <div class="p-3">
                <h2>Tambah kategori</h2>
                <form action="" method="POST" id="data-kategori">
                    <label for="namaKategori">Nama Kategori</label>
                    <input type="text" class="form-control" name="namaKategori" id="namaKategori">
                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-dark" name="submit" id="submit-kategori">Add</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-kategori w-75 m-3">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <th style="width: 5%;">ID</th>
                    <th style="width: 80%;">Kategori</th>
                    <th style="width: 15%;">Action</th>
                </thead>
                <tbody>
                    <?php foreach ($result as $row) : ?>
                        <tr>
                            <td><?= $row['id_kategori']; ?></td>
                            <td><?= $row['nama']; ?></td>
                            <td><button class="btn btn-danger delete" value="<?= $row['id_kategori']; ?>">Delete</button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>