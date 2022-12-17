<?php 
$user = $_SESSION['username_user'];

$result = 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="MDB5/css/mdb.min.css" />
    <script type="text/javascript" src="MDB5/js/mdb.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="fa_icons/css/all.css"> -->
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
</head>
<body style="background-color: #D0d2d2;">
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
            <h1 class="text-center m-3">Tulis Resep Baru</h1>

        </div>
    </div>
</body>
</html>