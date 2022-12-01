<?php
require("connect.php");

// var_dump($_GET);
$id = $_GET['id'];
$data = query("SELECT * FROM resep WHERE id_resep = '$id';");
$bahan = mysqli_query($conn, "SELECT * FROM bahan WHERE id_resep = $id");
$langkah = mysqli_query($conn,"SELECT * FROM langkah WHERE id_resep = '$id'");

// var_dump($data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link rel="stylesheet" href="detail.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <title><?= $data[0]["nama_resep"]; ?></title>
</head>

<body>
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
                <a class="navbar-brand mt-2 mt-lg-0" href="index.php" style='background-color:transparent'>
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
    <div class="blog-single gray-bg">
            <div class="container">
                <div class="row align-items-start">
                    <div class="col-lg-8 m-15px-tb">
                        <article class="article">
                            <div class="article-img">
                                <img src="img/<?= $data[0]["gambar"]; ?>" title="" alt="">
                            </div>
                            <div class="article-title">
                                <h2><?= $data[0]["nama_resep"]; ?></h2>
                                <div class="media">
                                    <div class="media-body">
                                        <label><?= $data[0]["author"]; ?></label>
                                        <span><?= $data[0]["tanggal"]; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="article-content">
                                <p><?= $data[0]["deskripsi"]; ?></p>
        
                            </div>
                            <div class = "bahan-content">
                                <p> Bahan & Takaran </p>
                                <?php while($r = mysqli_fetch_array($bahan,MYSQLI_ASSOC) ){?>
                                    <ul class="list-group">
                                        <li class="list-group-item"><?php echo $r['urutan'] + 1 ?>.   <?php echo $r['takaran'] ?> </li>
                                    </ul>
                                
                                <?php }?>
                            </div>
                            <div class = "langkah-content">
                                <p> Langkah Pembuatan </p>
                                <?php while($r = mysqli_fetch_array($langkah,MYSQLI_ASSOC) ){?>
                                    <ul class="list-group">
                                        <li class="list-group-item"><?php echo $r['urutan'] + 1 ?>.   <?php echo $r['langkah'] ?> </li>
                                    </ul>
                                
                                <?php }?>
                            </div>
                            
                        </article>
                    </div>      
                    <div class="col-lg-4 m-15px-tb blog-aside">
                        <!-- Author -->
                        <div class="widget widget-author">
                            <div class="widget-title">
                                <h3>Comments</h3>
                            </div>
                            <div class="media m-b-20">
                                <div class="d-flex mr-3">
                                    <a href="#"><img class="media-object rounded-circle thumb-sm" alt="64x64" src="https://bootdey.com/img/Content/avatar/avatar1.png"></a>
                                </div>
                                <div class="media-body">
                                    <h5 class="mt-0">Maxine Kennedy</h5>
                                    <p class="font-13 text-muted mb-0"><a href="" class="text-dark">@Michael</a> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio.</p><a href="" class="text-success font-13">Reply</a></div>
                            </div>
        
                        </div>
                        <!-- End Author -->
                    </div>
                </div>
            </div>
        </div>

</body>

</html>