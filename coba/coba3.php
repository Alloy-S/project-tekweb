<?php

if (isset($_POST['submit'])) {


	var_dump($_POST);
	$folderPath = 'upload/';

	$image_parts = explode(";base64,", $_POST['image-data']);
	$image_type_aux = explode("image/", $image_parts[0]);
	$image_type = $image_type_aux[1];
	$image_base64 = base64_decode($image_parts[1]);
	$filename = uniqid().'.png';
	$file = $folderPath . $filename;
	file_put_contents($file, $image_base64);
	echo '<script>alert("suskes terupload', $filename, '") </script>';
	// echo json_encode(["image uploaded successfully."]);
	
}

?>
