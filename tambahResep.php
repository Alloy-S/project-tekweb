<?php
session_start();

if (!isset($_SESSION["login_user"])) {
    header("Location: login2.php");
}
require('connect.php');
// var_dump($_POST);
if (isset($_POST["submit"])) {

    if (tambah_resep($_POST) > 0) {
        $_POST = array();
        echo "
    <script>
        alert('data berhasil ditambahkan!');
        // document.location.href = 'index.php';
    </script>
    ";
    } else {
        $_POST = array();
        echo "
    <script>
        alert('data gagal ditambahkan!');
        // document.location.href = 'index.php';
    </script>
    ";
    }
}

$data = query("SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tulis resep baru</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="MDB5/css/mdb.min.css" />
    <script type="text/javascript" src="MDB5/js/mdb.min.js"></script>
    <!-- bootstrap -->
    <!-- font awesome -->
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <!-- font awesome -->

    <!-- jQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- jQUERY -->

    <!-- CROPPER JS -->
    <link href="cropperjs/cropper.min.css" rel="stylesheet" type="text/css" />
    <script src="cropperjs/cropper.min.js" type="text/javascript"></script>
    <!-- CROPPER JS -->
    <script src="function/fungtion.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $("#add-row-langkah").click(function() {
                $("#row-langkah").append("<li><div class='row my-2'><div class='col-6'><input type='text' class='form-control' name='detail_langkah[]'></div><div class='col-2'><a class='delete-langkah'><i class='fa-sharp fa-solid fa-xmark fa-xl'></i></a></div></div></li>");
            });

            $("#add-row-bahan").click(function() {
                $("#row-bahan").append("<li><div class='row'><div class='col-5'><input type='text' class='form-control' name='detail_takaran[]' placeholder='takran'></div><div class='col-5'><input type='text' class='form-control' name='detail_bahan[]' placeholder='bahan'></div><div class='col-2'><a class='delete-bahan'><i class='fa-sharp fa-solid fa-xmark fa-xl'></i></a></div></div></li>");

            });

            $(document).on("click", ".delete-langkah", function(e) {
                $(this).parent().parent().parent().remove()
            });

            $(document).on("click", ".delete-bahan", function(e) {
                $(this).parent().parent().parent().remove()
            });



            // cropper
            var bs_modal = $('#modal');
            var image = document.getElementById('image-cropper');
            var cropper, reader, file, base64data;


            $("body").on("change", ".image", function(e) {
                // console.log("wkwkwkw");
                $("#image-data").val("")
                var files = e.target.files;
                var done = function(url) {
                    image.src = url;
                    bs_modal.modal('show');
                };


                if (files && files.length > 0) {
                    file = files[0];

                    if (URL) {
                        done(URL.createObjectURL(file));
                    } else if (FileReader) {
                        reader = new FileReader();
                        reader.onload = function(e) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });

            bs_modal.on('shown.bs.modal', function() {
                cropper = new Cropper(image, {
                    // aspectRatio: 16 / 9,
                    // viewMode: 3,
                    dragMode: 'move',
                    preview: '.preview',
                    autoCropArea: 0.8,
                    restore: false,
                    guides: false,
                    center: false,
                    highlight: false,
                    cropBoxMovable: false,
                    cropBoxResizable: false,
                    toggleDragModeOnDblclick: false,
                });
            }).on('hidden.bs.modal', function() {
                cropper.destroy();
                cropper = null;
            });

            $("#crop").click(function() {
                canvas = cropper.getCroppedCanvas({
                    width: 160,
                    height: 160,
                });

                canvas.toBlob(function(blob) {
                    url = URL.createObjectURL(blob);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {
                        base64data = reader.result;

                        // $("#image-data").val(base64data);

                        bs_modal.modal('hide');

                    };
                });
            });
            // cropper  

            $("#form-addResep").submit(function(e) {
                e.preventDefault();
                if (base64data != null) {
                    var uid = unique() + ".png";
                    $("#image-name").val(uid);
                    console.log(uid)
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "function/saveFile.php",
                        data: {
                            image: base64data,
                            uid: uid
                        },
                        success: function(data) {
                            console.log(data);
                            // alert("success upload image" + data);
                            // $("#image-data").val(data);
                        }
                    });
                    var form = $(this);
                    var formUrl = $(this).attr("action");
                    console.log(form.serialize());
                    $.ajax({
                        type: "POST",
                        url: formUrl,
                        data: form.serialize(),
                        // dataType: "json",
                        success: function(response) {
                            console.log("data berhasil ditambahkan");
                            console.log(response);
                            window.location.href = "index.php";
                        }, 
                        error: function() {
                            alert('eror');
                        }
                        
                    });
                } else {
                    alert("pilih gambar terlebih dahulu");
                }

            });
        });
    </script>
    <style>
        body {
            background-color: #D0d2d2;
        }

        .field-input {
            background-color: white;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 15px;
        }

        .content {
            width: 40%;
        }

        img {
            display: block;
            max-width: 100%;
        }

        .preview {
            overflow: hidden;
            width: 160px;
            height: 160px;
            margin: 10px;
            border: 1px solid red;
        }

        @media screen and (max-width: 992px) {
            .content {
                width: 100%;
            }
        }
    </style>
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
                <a class="navbar-brand mt-2 mt-lg-0" href="index.php">
                    <img src="img\Gudang Resep.png" height="40" alt="GR Logo" loading="lazy" />
                </a>

            </div>
            <!-- Collapsible wrapper -->

            <!-- Right elements -->
            <?php if (isset($_SESSION["login_user"])) : ?>
                <div class="d-flex align-items-center ">

                    <!-- Avatar -->
                    <div class="dropdown ">

                        <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            <img src="img/anonymous.jpg" class="rounded-circle" height="40" alt="Profile" loading="lazy" />
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                            <li>
                                <a class="dropdown-item" href="myprofile.php">My profile</a>
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

            <form action="function/tambahResepDb.php" method="post" id="form-addResep" enctype="multipart/form-data">
                <div class="field-input">

                    <label class="form-label" for="nama_resep">Judul Resep : </label>
                    <input class="form-control mb-2" type="text" name="nama_resep" id="nama_resep" maxlength="30" required>


                    <!-- <label for="nama">deskripsi : </label>
                <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"></textarea> -->
                    <label for="deskripsi" class="form-label">Deskripsi resep : </label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>

                    <select class="form-select mt-3" aria-label="Default select example" name="kategori" required>
                        <option selected>Pilih Kategori</option>
                        <?php foreach ($data as $row) : ?>

                            <option value="<?= $row['id_kategori']; ?>"><?= $row['nama']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="field-input">
                    <label class="mb-2" for="row-bahan">Bahan-bahan : </label>
                    <ol id="row-bahan">
                        <li>
                            <div class="row ">
                                <div class="col-5"><input type="text" class="form-control" name="detail_takaran[]" placeholder="takaran"></div>
                                <div class="col-5"><input type="text" class="form-control" name="detail_bahan[]" placeholder="bahan"></div>
                                <div class="col-2"><a class="delete-bahan"><i class="fa-solid fa-xmark fa-xl"></i></a></div>
                            </div>
                        </li>
                        <li>
                            <div class="row my-2">
                                <div class="col-5">
                                    <input type="text" class="form-control" name="detail_takaran[]" placeholder="takaran">
                                </div>
                                <div class="col-5">
                                    <input type="text" class="form-control" name="detail_bahan[]" placeholder="bahan">
                                </div>
                                <div class="col-2">
                                    <a class="delete-bahan"><i class="fa-sharp fa-solid fa-xmark fa-xl"></i></a>
                                </div>
                            </div>
                        </li>
                    </ol>
                    <button type="button" id="add-row-bahan" class="btn btn-outline-primary">add</button>
                </div>
                <div class="field-input">
                    <label for="row-langkah">Langkah-Langkah : </label>
                    <ol id="row-langkah">
                        <li>
                            <div class="row my-2">
                                <div class="col-6">
                                    <input type="text" class="form-control" name="detail_langkah[]">
                                </div>
                                <div class="col-2">
                                    <a class="delete-langkah"><i class="fa-sharp fa-solid fa-xmark fa-xl"></i></a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row my-2">
                                <div class="col-6">
                                    <input type="text" class="form-control" name="detail_langkah[]">
                                </div>
                                <div class="col-2">
                                    <a class="delete-langkah"><i class="fa-sharp fa-solid fa-xmark fa-xl"></i></a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row my-2">
                                <div class="col-6">
                                    <input type="text" class="form-control" name="detail_langkah[]">
                                </div>
                                <div class="col-2">
                                    <a class="delete-langkah"><i class="fa-sharp fa-solid fa-xmark fa-xl"></i></a>
                                </div>
                            </div>
                        </li>
                    </ol>
                    <button type="button" id="add-row-langkah" class="btn btn-outline-primary">add</button>
                </div>
                <div class="field-input">
                    <label for="jurusan">Gambar : </label>
                    <input class="form-control image" type="file">
                    <input type="hidden" name="image-name" id="image-name">

                    <select class="form-select mt-3" aria-label="Default select example" name="is_private" id="is_private" required>
                        <option value="false">Public</option>
                        <option value="true">Private</option>
                    </select>
                </div>

                <button class="btn btn-primary" type="submit" id="submit" name="submit">Submit</button>


            </form>
        </div>
    </div>

    <!-- MODAL CROPPER -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Crop image</h5>
                    <button type="button" class="close" data-mdb-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <!--  default image where we will set the src via jquery-->
                                <img id="image-cropper">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdn-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL CROPPER -->


</html>