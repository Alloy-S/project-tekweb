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
    <!-- CSS only
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> -->
    <title>Home</title>
    <link rel="stylesheet" href="MDB5/css/mdb.min.css" />
    <script type="text/javascript" src="MDB5/js/mdb.min.js"></script>
    <!-- <link rel="stylesheet" href="fa_icons/css/all.css"> -->
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
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
                <a class="navbar-brand mt-2 mt-lg-0" href="#">
                    <img src="img\Gudang Resep.png" height="45" alt="GR Logo" loading="lazy" />
                </a>
                <!-- <div class="container-xl ms-5 position-absolute top-50 start-100 translate-middle"> -->
                    <div class="input-group d-flex justify-content-center">
                        <div class="form-outline w-25">
                            <input type="search" id="form1" class="form-control"/>
                            <label class="form-label" for="form1">Search</label>
                        </div>
                        <button type="button" class="btn btn-outline-secondary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                <!-- </div> -->
            </div>
            <!-- Collapsible wrapper -->

            <!-- Right elements -->
            <?php if (isset($_SESSION["login"])) : ?>
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
                        <button type="button" class="btn btn-outline-primary btn-rounded" data-mdb-ripple-color="dark">Login</button>
                    </a>
                </div>
            <?php endif; ?>
            <!-- Right elements -->
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
    <div>
          <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container h-50 d-inline-block mt-4" style='background-color:coral'>
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          <h1>Better Solutions For Your Business</h1>
          <h2>We are team of talented designers making websites with Bootstrap</h2>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <img src="project\img\63708e6c90ecf.jpg" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section>
        <div class="">

        </div>
    </div>
    <div class="container ">
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
        <div class="d-flex">
            <?php foreach ($data as $row) : ?>
                <div class="card m-2" style="width: 18rem;">
                    <img src="img/<?= $row["gambar"]; ?>" class="card-img-top" alt="<?= $row["nama_resep"]; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row["nama_resep"]; ?></h5>
                        <!-- <p class="card-text"><?= $row["deskripsi"]; ?></p> -->
                        <a href="detailResep.php?id=<?= $row["id_resep"]; ?>" class="btn btn-primary sticky-bottom">More</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    
</body>

</html>