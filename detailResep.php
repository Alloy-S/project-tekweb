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
    <link rel="stylesheet" href="detail.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="MDB5/js/mdb.min.js"></script>
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
                    <img src="img\white.png" height="45" alt="GR Logo" loading="lazy" />
                </a>
                <!-- <div class="container-xl ms-5 position-absolute top-50 start-100 translate-middle"> -->
                <div class="input-group d-flex justify-content-center">
                    <div class="form-outline w-25">
                        <input type="search" id="form1" class="form-control text-light" />
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
                            <img src="img/resep_img/<?= $data[0]["gambar"]; ?>" title="" alt="">
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
                        <div class="bahan-content">
                            <p><strong> Bahan & Takaran </strong></p>
                            <?php while ($r = mysqli_fetch_array($bahan, MYSQLI_ASSOC)) { ?>
                                <ul class="list-group">
                                    <li class="list-group-item"><b> <?php echo $r['takaran'] ?> </b>
                                        <?php echo $r['jenis'] ?> </li>
                                </ul>

                            <?php } ?>
                        </div>
                        <div class="langkah-content">
                            <br>
                            <p><strong> Langkah Pembuatan</strong> </p>
                            <?php while ($r = mysqli_fetch_array($langkah, MYSQLI_ASSOC)) { ?>
                                <ul class="list-group">
                                    <li class="list-group-item"><?php echo $r['urutan'] + 1 ?>. <?php echo $r['langkah'] ?>
                                    </li>
                                </ul>

                            <?php } ?>
                        </div>

                    </article>
                </div>
                <div class="col-lg-4 m-15px-tb blog-aside">
                    <!-- Author -->
                    <div class="widget widget-author">
                        <div class="widget-title">
                            <h3>Comments</h3>
                        </div>
                        <form action="detailResep.php?id=<?php echo $id; ?>" method="POST">
                            <input type="hidden" name="id" value="<?php echo $id; ?>" required>

                            <p>
                                <label>Your name</label>
                                <input type="text" name="name" required>
                            </p>
                            <p>
                                <label>Comment</label>
                                <textarea name="comment" required></textarea>
                            </p>

                            <p>
                                <input type="submit" value="Add Comment" name="submit">
                                <?php
                                if (isset($_POST["submit"])) {
                                    $author = mysqli_real_escape_string($conn, $_POST["name"]);
                                    $comment = mysqli_real_escape_string($conn, $_POST["comment"]);
                                    $resep_id = $id;
                                    $reply = 0;

                                    mysqli_query($conn, "INSERT INTO comments(author, resep_id, comment, date_created, reply) VALUES ('" . $author . "',   $resep_id , '" . $comment . "', NOW(), '" . $reply . "')");
                                    echo "<script type='text/javascript'>alert('Comment posted');</script>";
                                }
                                ?>
                            </p>
                        </form>
                        <?php
                        foreach ($comments as $comment_key => $comment) {
                            // initialize replies array for each comment
                            $replies = array();

                            // check if it is a comment to post, not a reply to comment
                            if ($comment->reply == 0) {
                                // loop through all comments again
                                foreach ($comments as $reply_key => $rep) {
                                    // check if comment is a reply
                                    if ($rep->reply == $comment->comment_id) {
                                        // add in replies array
                                        array_push($replies, $rep);

                                        // remove from comments array
                                        unset($comments[$reply_key]);
                                    }
                                }
                            }

                            // assign replies to comments object
                            $comment->replies = $replies;
                        }

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
                        <ul class="comments">
                            <?php foreach ($comments as $comment) : ?>
                                <li>
                                    <p>
                                        <?php echo $comment->author; ?>
                                    </p>

                                    <p>
                                        <?php echo $comment->comment; ?>
                                    </p>

                                    <p>
                                        <?php echo date("F d, Y h:i a", strtotime($comment->date_created)); ?>
                                    </p>

                                    <div data-id="<?php echo $comment->comment_id; ?>" onclick="showFormReply(this);">
                                        <button>Reply</button>
                                    </div>

                                    <form action="detailResep.php" method="post" id="form-<?php echo $comment->id; ?>" style="display: none;">

                                        <input type="hidden" name="reply" value="<?php echo $comment->id; ?>" required>
                                        <input type="hidden" name="resep_id" value="<?php echo $post_id; ?>" required>

                                        <p>
                                            <label>Your name</label>
                                            <input type="text" name="name" required>
                                        </p>

                                        <p>
                                            <label>Your email address</label>
                                            <input type="email" name="email" required>
                                        </p>

                                        <p>
                                            <label>Comment</label>
                                            <textarea name="comment" required></textarea>
                                        </p>

                                        <p>
                                            <input type="submit" value="Reply" name="do_reply">
                                        </p>
                                    </form>
                                </li>
                            <?php endforeach; ?>
                    </div>
                    <!-- End Author -->
                </div>
            </div>
        </div>
    </div>

</body>

</html>