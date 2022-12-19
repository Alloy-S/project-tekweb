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
</head>

<body>
    <!-- Navbar-->
    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->

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
                        <a class="nav-link" href="approvalPage.php">Approval Page</a>
                    </li>
                    <li class="nav-item ms-4">
                        <a class="nav-link active" href="tambahKategori.php">Add New Category</a>
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

    <div class="container-fluid d-flex flex-row">
        <div class="w-25 m-3">
            <h2>Tambah kategori</h2>
            <form action="" method="POST" id="data-kategori">
                <label for="namaKategori">Nama Kategori</label>
                <input type="text" class="form-control" name="namaKategori" id="namaKategori">
                <div class="d-grid gap-2 mt-3">
                    <button type="submit" class="btn btn-dark" name="submit" id="submit-kategori">Add</button>
                </div>
            </form>
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