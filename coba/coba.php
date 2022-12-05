<?php

?>


<html>

<head>
	<title>Crop Before Uploading Image using Cropper JS & PHP</title>
	<!-- CSS only -->
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<!-- JavaScript Bundle with Popper -->
	<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> --> -->
	<link rel="stylesheet" href="../MDB5/css/mdb.min.css" />
	<script type="text/javascript" src="../MDB5/js/mdb.min.js"></script>
	<link href="../cropperjs/cropper.min.css" rel="stylesheet" type="text/css" />
	<script src="../cropperjs/cropper.min.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	<script>
		$(document).ready(function() {


			// cropper
			var bs_modal = $('#modal');
			var image = document.getElementById('image');
			var cropper, reader, file;


			$("body").on("change", ".image", function(e) {
				console.log("wkwkwkw");
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
</head>
<style type="text/css">
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
</style>

<body>
<div class="container-fluid d-flex align-items-center justify-content-center">
        <div class="content">
            <h1 class="text-center m-3">Tulis Resep Baru</h1>

            <form action="coba3.php" method="post" enctype="multipart/form-data">
            <input type="text" name="image-data" id="image-data" disabled>
                <div class="field-input">

                    <label class="form-label" for="nama_resep">Judul Resep : </label>
                    <input class="form-control" type="text" name="nama_resep" id="nama_resep" maxlength="30" required>


                    <!-- <label for="nama">deskripsi : </label>
                <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"></textarea> -->
                    <label for="deskripsi" class="form-label">Deskripsi resep</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>

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
                    <!-- <input type="file" name="gambar" id="gambar"> -->
                    <input class="form-control image" type="file" >
                    
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
	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
					<button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					...
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>

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
								<img id="image">
							</div>
							<div class="col-md-4">
								<div class="preview"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary" id="crop">Crop</button>
				</div>
			</div>
		</div>
	</div>

	</div>
	</div>


</body>

</html>