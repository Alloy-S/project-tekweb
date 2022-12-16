<?php
require("../connect.php");
$id = $_POST['id'];

$status = $_POST['status'];
$count = mysqli_query($conn, "SELECT likes FROM resep WHERE id_resep = '$id'");
$count = mysqli_fetch_assoc($count);

if ($status == "0") {
    $count =  ((int)$count['likes']) + 1;
    $result = mysqli_query($conn, "UPDATE resep SET likes = $count WHERE id_resep ='$id'");
} else {
    $count =  ((int)$count['likes']) - 1;
    $result = mysqli_query($conn, "UPDATE resep SET likes = $count WHERE id_resep = '$id'");
}

echo json_encode($count);
?>