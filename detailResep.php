<?php
require("connect.php");

// var_dump($_GET);
$id = $_GET['id'];
$data = query("SELECT * FROM resep WHERE id_resep = '$id';");
// var_dump($data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <title><?= $data[0]["nama_resep"]; ?></title>
</head>

<body>
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
                                    <span>Tanggal</span>
                                </div>
                            </div>
                        </div>
                        <div class="article-content">
                            <p><?= $data[0]["deskripsi"]; ?></p>
    
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