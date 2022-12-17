<?php 
include("../connect.php");

$id_resep = $_POST['id'];
$method = $_POST['method'];
if ($method === "publish") {
    $result = mysqli_query($conn, "UPDATE resep SET is_approved = true WHERE id_resep = '$id_resep'");
    echo "Resep berhasil di-publish!";
} elseif ($method === "takedown"){
    $result = mysqli_query($conn, "UPDATE resep SET is_approved = false WHERE id_resep = '$id_resep'");
    echo "Resep berhasil di-takedown!";
} elseif ($method === "delete") {
    $result = mysqli_query($conn, "DELETE FROM resep WHERE id_resep = '$id_resep'");
    echo "Resep berhasil di-delete!";
}
?>