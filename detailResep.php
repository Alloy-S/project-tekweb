<?php
session_start();
require("connect.php");

// var_dump($_GET);
$id = $_GET['id'];


$count = query("SELECT views FROM resep WHERE id_resep = $id;");
$count =  ((int)$count[0]['views']) + 1;


$qry = "UPDATE resep SET views = $count WHERE id_resep = $id;";
$view = mysqli_query($conn, $qry);

$data = query("SELECT * FROM resep WHERE id_resep = '$id';");
$bahan = mysqli_query($conn, "SELECT * FROM bahan WHERE id_resep = '$id';");
$langkah = mysqli_query($conn, "SELECT * FROM langkah WHERE id_resep = '$id';");
// var_dump($data);

$que = mysqli_query($conn, "SELECT * FROM comments WHERE id_resep = '$id';");

// save all records from database in an array
$comments = array();
while ($r = mysqli_fetch_object($que)) {
    array_push($comments, $r);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link rel="stylesheet" href="detail-dum.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="MDB5/js/mdb.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <title><?= $data[0]["nama_resep"]; ?></title>
</head>

<body style='background-color:#c6c9ca'>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top" style='background-color:black'>
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
    
    <div class="blog-single">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-lg-8 m-15px-tb">
                    <article class="article">
                        <div class="article-part">
                            <div class="article-img">
                                <img class="img-responsive" src="img/resep_img/<?= $data[0]["gambar"]; ?>" title="" alt="">
                            </div>
                    
                            <div class="article-title">
                                <h2 style="display:inline;"> <?= $data[0]["nama_resep"]; ?> </h2>
                                <!-- <button class="btn-secondary like">
                                                <i class="fa fa-heart" aria-hidden="true"></i> Like
                                            </button>
                                    
                                        -->
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
                        </div>

                        <div class="article-part">
                            <div class="bahan-content">
                                <p><strong> Bahan & Takaran </strong></p>
                                <?php while ($r = mysqli_fetch_array($bahan, MYSQLI_ASSOC)) { ?>
                                    <ul class="list-group">
                                        <li class="list-group-item mb-2"><b> <?php echo $r['takaran'] ?> </b>
                                            <?php echo $r['jenis'] ?> </li>
                                    </ul>

                                <?php } ?>
                            </div>
                        </div>

                        <div class="article-part">
                            <div class="langkah-content">
                                <br>
                                <p><strong> Langkah Pembuatan</strong> </p>
                                <?php while ($r = mysqli_fetch_array($langkah, MYSQLI_ASSOC)) { ?>
                                    <ul class="list-group">
                                        <li class="list-group-item mb-2"><?php echo $r['urutan'] + 1 ?>. <?php echo $r['langkah'] ?>
                                        </li>
                                    </ul>

                                <?php } ?>
                            </div>
                        </div>

                    </article>
                </div>
                <div class="col-lg-4 m-15px-tb blog-aside">
                    <!-- Author -->
                    <div class="widget widget-author">
                        <div class="widget-title">
                            <h3>Comments</h3>
                        </div>
                        <div class="form-group mx-3">
                        <form method="POST" id = "comment-form" >
                                <input type="hidden" id = "id" name="id" value="<?php echo $id; ?>" required>
                            
                                <div class="hstack gap-2 mx-3 my-3">
                                        <label>Your name</label> <br/>
                                    <div class="col-auto">
                                        <input class="form-control" type="text" id = "name" name="name" required>
                                    </div>
                                </div>

                                <div class="mx-3 mb-4">
                                    <div class="col-auto mb-2">
                                        <label>Comment</label>
                                    </div>
                                    <div class="col-auto mx-0">
                                        <textarea class="form-control" name="comment" id = "comment" name = "comment" required></textarea>
                                    </div>
                                </div>
                                
                                <div class="mx-3 mb-3">
                                    <input type = "submit" id = "submit" name = "submit" class = "btn btn-secondary">
                                </div>
                         
                            </form>
                        </div>
                        <div class="com-sec"></div>
                        <script>
                            $(document).ready(function(){
                                $("#submit").click(function(event){
                                    event.preventDefault(); 
                                    event.stopImmediatePropagation();
                                    // $("#comment-form :input").prop("disabled", false);
                                    // var vid  = $("#id").val();
                                    // var vname  = $("#name").val();
                                    // var vcomment  = $("#comment").val();
                                    // var form = $(this);
                                    // var formUrl = $(this).attr("action");
                                    console.log($("#comment-form").serialize());

                                    $.ajax({
                                        url:"addComment.php",
                                        type:"POST",
                                        data:$("#comment-form").serialize(),
                                        success:function(data){ 
                                            console.log(data);                        
                                        },
                                        error:function(xhr, status, error){
                                            console.log(error);
                                        },
                                    })
                                    return false   
                                })
                                });

                                // load_comment();

                                function load_comment()
                                {
                                $.ajax({
                                url:"showComment.php",
                                method:"POST",
                                datatype:"JSON",    
                                success:function(data)
                                {
                                    $('#com-sec').html(data);
                                }
                                })
                                }

                                // );$(document).on('click', '.reply', function(){
                                // var comment_id = $(this).attr("id");
                                // $('#comment_id').val(comment_id);
                                // $('#comment_name').focus();
                                // }
                                
                                ;
                                </script>
                        </form>
                       
                    </div>
                    <!-- End Author -->
                </div>
            </div>
        </div>
    </div>

</body>

</html>