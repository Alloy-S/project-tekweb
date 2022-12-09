<?php
session_start();
require("connect.php");
// if (!isset($_SESSION["login"])) {
//     header("Location: login.php");
// }

$data = query("SELECT * FROM resep WHERE is_approved = 1");
// var_dump($data);
// print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> -->
    <title>Home</title>
    <link rel="stylesheet" href="MDB5/css/mdb.min.css" />
    <script type="text/javascript" src="MDB5/js/mdb.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="fa_icons/css/all.css"> -->
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body style='background-color:#c6c9ca'>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top" id='navbar'='background-color:transparent'>
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
                    <img src="img\white.png" height="45" alt="GR Logo" loading="lazy" />
                </a>
                <!-- <div class="container-xl ms-5 position-absolute top-50 start-100 translate-middle"> -->
                <div class="input-group d-flex justify-content-center">
                    <div class="coba form-outline w-25 rounded border border-light" style="--bs-border-opacity: .5;">
                        <form class="d-flex flex-row" action="search.php" method="POST">
                            <input id="search-input" type="search" name="search_index" class="form-control text-light" />
                            <button type="submit" id='myBtn' class="btn" name="submit_btn" style="background-color:transparent; line-height:2.3">
                                <i class="fas fa-search text-light"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <!-- </div> -->
            </div>
            <!-- Collapsible wrapper -->
            <!-- Right elements -->
            <?php if (isset($_SESSION["login_user"])) : ?>
                <div class="d-flex align-items-center">
                    <!-- Icon -->
                    <a class="text-reset me-3" href="#">
                        <i class="fas fa-shopping-cart"></i>
                    </a>

                    <!-- Notifications -->
                    <div class="dropdown">
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
                    </div>
                    <!-- Avatar -->
                    <div class="dropdown">
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
            <p>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Optio libero
                corrupti, consequuntur, blanditiis, sint quod maxime molestiae
                voluptatibus ratione neque
            </p>
            <h1>GUDANG RESEP</h1>
            <button type="button" class="btn btn-primary" id="bounce" onClick="document.getElementById('card-resep').scrollIntoView();" style="margin-bottom: 5vw; margin-top:4vw;">
                <i class="fa-regular fa-solid fa-arrow-down fa-xl"></i>
            </button>
        </div>
    </div>

    <div class="container" id='card-resep'>
        <div class="d-flex">
            <?php if (isset($_SESSION["login_user"])) : ?>
                <div class="button-group">
                    <a href="logout.php">
                        <button type="button" class="btn btn-primary">Logout</button>
                    </a>
                    <a href="tambahResep.php">
                        <button type="button" class="btn btn-primary">tambah resep</button>
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <br>
        <div>
            <div class="row g-2">
                <?php foreach ($data as $row) : ?>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card m-2">
                            <div class="ratio ratio-16x9">
                                <img src="img/resep_img/<?= $row["gambar"]; ?>" class="card-img-top" alt="<?= $row["nama_resep"]; ?>" style="object-fit:cover;">
                            </div>
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $row["nama_resep"]; ?></h5>
                                    <div>
                                        </span><i class="fa-solid fa-eye"></i><span id="like"><?= $row['views']; ?> 
                                    </div>
                                    <!-- <p class="card-text"><?= $row["deskripsi"]; ?></p> -->
                                    <a href="detailResep.php?id=<?= $row["id_resep"]; ?>" class="btn btn-primary sticky-bottom">More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <script>
            $(window).scroll(function() {
                if ($(document).scrollTop() > 70) {
                    $('#navbar').addClass('color-change');
                } else {
                    $('#navbar').removeClass('color-change');
                }
            });
        </script>
</body>

</html>