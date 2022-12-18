<?php
session_start();
require("connect.php");
// if (!isset($_SESSION["login"])) {
//     header("Location: login.php");
// }

if (!isset ($_GET['page']) ) {  
    $page_number = 1;  
} else {  
    $page_number = $_GET['page'];  
}  

$limit = 8; //harusnya 8
$initial_page = ($page_number-1) * $limit;
$previous = $page_number - 1;
$next = $page_number + 1; 

$data = query("SELECT * FROM resep WHERE is_approved = 1");
// var_dump($data);
// print_r($_SESSION);

$total_rows = count($data);
$total_pages = ceil($total_rows / $limit);

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
    <script>
        $(document).ready(function() {
            $(window).scroll(function() {
                if ($(document).scrollTop() > 10) {
                    $('#navbar').addClass('color-change');
                } else {
                    $('#navbar').removeClass('color-change');
                }
            });

            $("body").on("click", ".btn-like", function() {
                const btn = $(this);
                if ($(this).attr("status") == "0") {
                    $.ajax({
                        type: "POST",
                        url: "ajax/likeDislike.php",
                        data: {
                            id: btn.attr("value"),
                            status: btn.attr("status")
                        },
                        success: function(response) {
                            // alert(response);
                            btn.html("<span style='color: red;'><i class='fa-solid fa-heart'></i></span><span class='like'>" + response + "</span>");
                            btn.attr("status", 1);
                        }
                    });


                } else {
                    $.ajax({
                        type: "POST",
                        url: "ajax/likeDislike.php",
                        data: {
                            id: btn.attr("value"),
                            status: btn.attr("status")
                        },
                        success: function(response) {
                            // alert(response);
                            btn.html("<span style='color: red;'><i class='fa-regular fa-heart'></i></span><span class='like'>" + response + "</span>");
                            btn.attr("status", 0);
                        }
                    });
                }


            });
        });
    </script>
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
                                <a class="dropdown-item" href="myprofile.php">My profile</a>
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
        <div class="jumbotron" style="margin-left:6%">
            <!-- style="margin-left: 9vw; margin-top:1vw;" -->
            <h1 style="font-size:clamp(60px, 5vw, 220px);">GUDANG RESEP</h1>
            <button type="button" class="btn btn-primary" id="bounce" style="margin-left: 20%; margin-bottom:55%" onClick="document.getElementById('card-resep').scrollIntoView();">
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
        
        <div>
            <div class="row g-2">
            
                <?php
                    $data = query("SELECT *FROM resep WHERE is_approved = 1 LIMIT " . $initial_page . ',' . $limit);
                    foreach ($data as $row) : ?>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card m-2">
                            <a href="detailResep.php?id=<?= $row["id_resep"]; ?>">
                                <div class="ratio ratio-16x9">
                                    <img src="img/resep_img/<?= $row["gambar"]; ?>" class="card-img-top" alt="<?= $row["nama_resep"]; ?>" style="object-fit:cover;">
                                </div>
                            </a>
                            <div class="card text-center">
                                <a href="detailResep.php?id=<?= $row["id_resep"]; ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $row["nama_resep"]; ?></h5>
                                    </div>
                                </a>
                                <div class="icon-content d-flex flex-row justify-content-center">
                                    <div class="icon-field">
                                        <i class="fa-solid fa-eye"></i><span id="view"><?= $row['views']; ?></span>
                                    </div>
                                    <div class="icon-field btn-like" value="<?= $row['id_resep']; ?>" status="0">
                                        <span style="color: red;">
                                            <i class="fa-regular fa-heart"></i>
                                        </span>
                                        <span class="like"><?= $row['likes']; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
    <nav style="margin-bottom: -12%; margin-top: 5%;">
        <ul class="pagination pagination-md justify-content-center">
            <li class="page-item">
                <a class="page-link" <?php if($page_number > 1){ echo "href='?page=$previous'"; } ?>>Previous</a>
            </li>
            <?php
            for($page=1;$page<=$total_pages;$page++){
            ?>
                <li class="page-item <?php echo ($page == $page_number ? "active" : "") ?>"><a class="page-link" href="?page=<?php echo $page ?>"><?php echo $page; ?></a></li>             
            <?php }
            ?>              
            <li class="page-item">
                <a class="page-link" <?php if($page_number < $total_pages){ echo "href='?page=$next'"; } ?>>Next</a>
            </li>
        </ul>
    </nav> 

    <footer class="text-center text-white" style="background-color: #caced1;">
        <!-- Grid container -->
        <div class="container-fluid p-4" style="width: 100%; margin-top:15%">
            <!-- Section: Images -->
            <section class="">
                <div class="row">
                    <div class="col-sm">
                        <div class="bg-image hover-overlay ripple shadow-1-strong rounded" data-ripple-color="light">
                            <img src="img/foto 1.jpg" class="w-100" />
                            <a href="#!">
                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.2);"></div>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="bg-image hover-overlay ripple shadow-1-strong rounded" data-ripple-color="light">
                            <img src="img/foto2.png" class="w-100" />
                            <a href="#!">
                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.2);"></div>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="bg-image hover-overlay ripple shadow-1-strong rounded" data-ripple-color="light">
                            <img src="img/foto 3.jpg" class="w-100" />
                            <a href="#!">
                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.2);"></div>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="bg-image hover-overlay ripple shadow-1-strong rounded" data-ripple-color="light">
                            <img src="img/foto 4.jpg" class="w-100" />
                            <a href="#!">
                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.2);"></div>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="bg-image hover-overlay ripple shadow-1-strong rounded" data-ripple-color="light">
                            <img src="img/foto 5.jpg" class="w-100" />
                            <a href="#!">
                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.2);"></div>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Section: Images -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2022 Copyright:
            <a class="text-white" href="https://mdbootstrap.com/">Kelompok TEKWEB 5</a>
        </div>
        <!-- Copyright -->
    </footer>
</body>

</html>

