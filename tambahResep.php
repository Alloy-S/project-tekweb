<?php
session_start();
include('connect.php');
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
}
require('connect.php');

if (isset($_POST["submit"])) {


    if (tambah_resep($_POST) > 0) {
        echo "
    <script>
        alert('data berhasil ditambahkan!');
        document.location.href = 'index.php';
    </script>
    ";
    } else {
        echo "
    <script>
        alert('data gagal ditambahkan!');
        document.location.href = 'index.php';
    </script>
    ";
    }

    $data = query("SELECT * FROM kategori");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah resep baru</title>
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
            var cropper, reader, file;


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
                        var base64data = reader.result;
                        $("#image-data").val(base64data);

                        bs_modal.modal('hide');
                        // $.ajax({
                        //     type: "POST",
                        //     dataType: "json",
                        //     url: "coba3.php",
                        //     data: {image: base64data},
                        //     success: function(data) { 
                        //         bs_modal.modal('hide');
                        //         alert("success upload image");

                        //     }
                        // });
                    };
                });
            });
            // cropper  
        });
    </script>
    <style>
        body {
            background-color: #E9ffda;
        }



        .field-input {
            background-color: white;
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
                    <img src="img\Gudang Resep.png" height="45" alt="GR Logo" loading="lazy" />
                </a>
                <!-- <div class="container-xl ms-5 position-absolute top-50 start-100 translate-middle"> -->
                <!-- <div class="input-group d-flex justify-content-center">
                    <div class="form-outline w-25">
                        <input type="search" id="form1" class="form-control" />
                        <label class="form-label" for="form1">Search</label>
                    </div>
                    <button type="button" class="btn btn-outline-secondary">
                        <i class="fas fa-search"></i>
                    </button>
                </div> -->
                <!-- </div> -->
            </div>
            <!-- Collapsible wrapper -->

            <!-- Right elements -->
            <?php if (isset($_SESSION["login"])) : ?>
                <div class="d-flex align-items-center mt-md-4">

                    <!-- Notifications -->
                    <!-- <div class="dropdown">
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
                    </div> -->
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

            <form action="" method="post" enctype="multipart/form-data">
                <div class="field-input">

                    <label class="form-label" for="nama_resep">Judul Resep : </label>
                    <input class="form-control" type="text" name="nama_resep" id="nama_resep" maxlength="30" required>


                    <!-- <label for="nama">deskripsi : </label>
                <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"></textarea> -->
                    <label for="deskripsi" class="form-label">Deskripsi resep</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                    <select class="form-select mt-3" aria-label="Default select example" id="kategori">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="field-input">
                    <label for="row-bahan">bahan-bahan</label>
                    <ol id="row-bahan">
                        <li>
                            <div class="row ">
                                <div class="col-5"><input type="text" class="form-control" name="detail_takaran[]" placeholder="takran"></div>
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
                    <label for="row-langkah">Langkah-Langkah</label>
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
                    <input class="form-control image" type="file" name="gambar">
                    <input type="hidden" name="image-data" id="image-data" disabled>

                </div>
                <!-- <li>
                <label for="gambar">Gambar : </label>
                <input type="file" name="gambar" id ="gambar">
            </li> -->

                <div class="field-input">
                    <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                </div>

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