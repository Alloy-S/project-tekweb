<?php 
include("../connect.php");

$id_resep = $_POST['id'];
$result = mysqli_query($conn, "UPDATE resep SET is_approved = true WHERE id_resep = '$id_resep'");
echo "data berhasil di approve";

?>