<?php
session_start();
if (!isset($_SESSION["login_admin"])) {
    header("Location: login_admin.php");
}
require("../connect.php");

// var_dump($_GET);
$id = $_GET['id'];
$data = query("SELECT * FROM resep WHERE id_resep = '$id';");
$bahan = mysqli_query($conn, "SELECT * FROM bahan WHERE id_resep = '$id';");
$langkah = mysqli_query($conn, "SELECT * FROM langkah WHERE id_resep = '$id';");
// var_dump($data);

// $que = mysqli_query($conn, "SELECT * FROM comments WHERE id_resep = '$id';");

// save all records from database in an array
// $comments = array();
// while ($r = mysqli_fetch_object($que))
// {
//     array_push($comments, $r);
// }
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
    <!-- <link rel="stylesheet" href="assets/fontawesome/css/all.css"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="MDB5/js/mdb.min.js"></script>
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Admin Detail Recipe</title>

    <script>
        $(document).ready(function() {
            $('.btn-action').click(function() {
                var id = $(this).val();
                var method = $(this).attr("method");
                $.ajax({
                    type: 'POST',
                    url: '../ajax/connect_btn.php',
                    data: {
                        id: id,
                        method: method
                    },
                    success: function(response) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response,
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }
                });
            });
        });
    </script>
    <title>
        <?= $data[0]["nama_resep"]; ?>
    </title>

    <style>
        @media screen and (min-width: 340px) and (max-width: 790px) {
            .article-img {
                width: 60% !important;
                height: auto !important;
            }

            .pilihan {
                align-items: center;
                justify-content: center;
                text-align: center;
                /* margin-left: 15%; */
                margin-bottom: 5%;
            }

            .img-fluid {
                max-width: 100%;
            }

            .menu-pilihan {
                display: flex;
                justify-content: center;
                align-items: center;
                /* text-align: center;
                min-height: 100vh; */
            }
        }

        .img-fluid {
            max-width: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <a class="navbar-brand ms-2 pt-3 logo" href="index.php" style='background-color:transparent;'>
            <img src="black.png" height="55" alt="GR Logo" loading="lazy" />
        </a>
    </div>

    <!-- Navbar -->
    <div class="blog-single gray-bg">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-lg-8 m-15px-tb">
                    <article class="article">
                        <a href="approvalPage.php" class="btn btn-secondary btn-sm mt-4">&laquo; Kembali</a>
                        <div class="article-img mt-2">
                            <img src="../img/resep_img/<?= $data[0]["gambar"]; ?>" title="" alt="" class="img-fluid">
                        </div>
                        <div class="article-title mt-4">
                            <h2 style="display:inline;">
                                <?= $data[0]["nama_resep"]; ?>
                            </h2>
                            <!-- <button class="btn-secondary like">
                                            <i class="fa fa-heart" aria-hidden="true"></i> Like
                                        </button>
                                  
                                     -->
                            <div class="media">
                                <div class="media-body">
                                    <label>
                                        <?= $data[0]["author"]; ?>
                                    </label>
                                    <span>
                                        <?= $data[0]["tanggal"]; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="article-content mt-4">
                            <p>
                                <?= $data[0]["deskripsi"]; ?>
                            </p>

                        </div>
                        <div class="bahan-content">
                            <p><strong> Bahan & Takaran </strong></p>
                            <?php while ($r = mysqli_fetch_array($bahan, MYSQLI_ASSOC)) { ?>
                                <ul class="list-group">
                                    <li class="list-group-item"><b>
                                            <?php echo $r['takaran'] ?>
                                        </b>
                                        <?php echo $r['jenis'] ?>
                                    </li>
                                </ul>

                            <?php } ?>
                        </div>
                        <div class="langkah-content mb-5">
                            <br>
                            <p><strong> Langkah Pembuatan </strong></p>
                            <?php while ($r = mysqli_fetch_array($langkah, MYSQLI_ASSOC)) { ?>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <?php echo $r['urutan'] + 1 ?>.
                                        <?php echo $r['langkah'] ?>
                                    </li>
                                </ul>

                            <?php } ?>
                        </div>

                    </article>
                </div>
                <div class="col-lg-4 m-15px-tb blog-aside">
                    <!-- Author -->
                    <div class="widget widget-author mt-5 pilihan">
                        <div class="widget-title">
                            <h3 class="text-center mt-4 mb-3">Action</h3>
                        </div>
                        <div class="card text-center menu-pilihan">

                            <div class="card-header">Opsi Pilihan</div>
                            <div class="card-body" style="display: flex; flex-direction: column">
                                <button method="publish" type="button" value="<?= $data[0]["id_resep"]; ?>" id="publish" class="btn btn-primary btn-action p-lg-3 me-lg-2 mb-2">Publish <i class="fa fa-check" aria-hidden="true"></i></button>
                                <button method="takedown" type="button" value="<?= $data[0]["id_resep"]; ?>" id="takedown" class="btn btn-warning text-white btn-action p-lg-3 me-lg-2 mb-2"> Takedown <i class="fa-regular fa-clock"></i></button>
                                <button method="delete" type="button" value="<?= $data[0]["id_resep"]; ?>" id="delete" class="btn btn-danger btn-action p-lg-3 me-lg-2 mb-2"> Delete <i class="fa fa-times" aria-hidden="true"></i></button>
                            </div>
                            <!-- <div class="card-footer text-muted">2 days ago</div> -->
                        </div>
                        <?php
                        // foreach ($comments as $comment_key => $comment)
                        //         {
                        //             // initialize replies array for each comment
                        //             $replies = array();

                        //             // check if it is a comment to post, not a reply to comment
                        //             if ($comment->reply == 0)
                        //             {
                        //                 // loop through all comments again
                        //                 foreach ($comments as $reply_key => $rep)
                        //                 {
                        //                     // check if comment is a reply
                        //                     if ($rep->reply == $comment->comment_id)
                        //                     {
                        //                         // add in replies array
                        //                         array_push($replies, $rep);

                        //                         // remove from comments array
                        //                         unset($comments[$reply_key]);
                        //                     }
                        //                 }
                        //             }

                        //             // assign replies to comments object
                        //             $comment->replies = $replies;
                        //         }

                        ?>

                        <script>
                            function showFormReply(self) {
                                var commentId = self.getAttribute("data-id");
                                if (document.getElementById("form-" + commentId).style.display == "") {
                                    document.getElementById("form-" + commentId).style.display = "none";
                                } else {
                                    document.getElementById("form-" + commentId).style.display = "";
                                }
                            }
                        </script>

                        <!-- End Author -->
                    </div>
                </div>
            </div>
        </div>

</body>

</html>