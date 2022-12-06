<?php 
include("../connect.php");

$id_resep = $_POST['id'];
$method = $_POST['method'];
echo var_dump($_POST);
if ($method === "approve") {
    $result = mysqli_query($conn, "UPDATE resep SET is_approved = true WHERE id_resep = '$id_resep'");
    echo "data ter approve";
} elseif ($method === "takedown")
{
    $result = mysqli_query($conn, "UPDATE resep SET is_approved = false WHERE id_resep = '$id_resep'");
    echo "data di takedown";
}

?>

